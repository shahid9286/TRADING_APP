<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RoleNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\GeneralRoleDatabaseNotification;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use \Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    protected $notificationService;

    // Inject the service through constructor
    public function __construct(RoleNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $users = User::role('user')->orderBy('id', 'desc')->get();
        return view("admin.user.index", compact("users"));
    }

    public function add()
    {
        return view("admin.user.add");
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
            'address' => 'nullable',
            'icon' => 'nullable|max:1024|mimes:jpg,jpeg,png,webp',
            'status' => 'nullable',
            'user_type' => 'required',
            'phone_no' => 'required|max:20',
            'whatsapp_no' => 'required|max:20'
        ]);

        $user = new User();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $extension;
            $file->move('assets/admin/uploads/user/thumb/', $icon);
            $user->icon = $icon;

            $imgManager = new ImageManager(new Driver());

            $thumb_icon = $imgManager->read('assets/admin/uploads/user/thumb/' . $icon);
            $thumb_icon->cover(200, 200);
            $thumb_icon->save(public_path('admin/user/profile/' . $icon));

            @unlink('assets/admin/uploads/user/thumb/' . $icon);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->user_type = $request->user_type;
        $user->address = $request->address;
        $user->phone_no = $request->phone_no;
        $user->whatsapp_no = $request->whatsapp_no;

        $user->save();




        // Notification to super admins
        $superAdminNotificationData = [
            'title' => 'New User Created',
            'message' => 'A new user (' . $user->name . ') has been created in the system.',
            'link' => route('admin.user.index'),
            'role' => 'superAdmin'
        ];
        $this->notificationService->notifyAllSuperAdmins('superAdmin', $superAdminNotificationData);

        // Notification to the newly created user
        $userNotificationData = [
            'title' => 'Welcome to Our System',
            'message' => 'Your account has been successfully created. Welcome aboard!',
            'link' => '#', // Set appropriate link
        ];
        $user->notify(new GeneralRoleDatabaseNotification($userNotificationData));

        $notification = array(
            'alert' => 'success',
            'message' => 'User Added Successfuly!'
        );

        return redirect()->route('admin.user.index')->with('notification', $notification);
    }

    public function detail($id)
    {
        $user = User::find($id)->load([
            'referral',
            'level1',
            'level2',
            'level3',
            'level4',
            'level5',
            'level6',
            'level7',
            'investments',
            'withdrawalRequests'
        ]);
        if (!$user)
            return redirect()->back()->with('notification', ['alert' => 'success', 'message' => 'User Not Found!']);
        return view('admin.user.detail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("admin.user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,' . $id,
            'address' => 'nullable',
            'icon' => 'nullable|max:1024|mimes:jpg,jpeg,png,webp',
            'status' => 'nullable',
            'user_type' => 'required',
            'phone_no' => 'required|max:20',
            'whatsapp_no' => 'required|max:20'
        ]);

        $user = User::find($id);

        if ($request->hasFile('icon')) {

            @unlink('assets/admin/uploads/user/' . $user->icon);

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $extension;
            $file->move('assets/admin/uploads/user/thumb/', $icon);
            $user->icon = $icon;

            $imgManager = new ImageManager(new Driver());

            $thumb_icon = $imgManager->read('assets/admin/uploads/user/thumb/' . $icon);
            $thumb_icon->cover(200, 200);
            $thumb_icon->save(public_path('admin/user/profile/' . $icon));

            @unlink('assets/admin/uploads/user/thumb/' . $icon);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->whatsapp_no = $request->whatsapp_no;
        $user->user_type = $request->user_type;
        $user->address = $request->address;
        $user->branch_id = auth()->user()->branch_id;
        $user->save();

        $notification = [
            'alert' => 'success',
            'message' => 'User Updated Successfully!'
        ];

        return redirect()->route('admin.user.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not Delete Admin!'
            ];
            return redirect()->back()->with('notification', $notification);
        } elseif ($user->id == Auth::user()->id) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not Delete Your User!'
            ];
            return redirect()->back()->with('notification', $notification);
        } else {

            @unlink('admin/user/profile/' . $user->icon);

            $user->delete();
            $notification = [
                'alert' => 'success',
                'message' => 'User Deleted Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function makependingUser($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not change Status of Admin!'
            ];
            return redirect()->back()->with('notification', $notification);
        } else {

            $user->status = 'pending';
            $user->save();
            $notification = [
                'alert' => 'success',
                'message' => 'User Maked Pending Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function makeapprovedUser($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not change Status of Admin!'
            ];
            return redirect()->back()->with('notification', $notification);
        } else {

            $user->status = 'approved';
            $user->save();
            $notification = [
                'alert' => 'success',
                'message' => 'User Maked Approved Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function makeblockedUser($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not change Status of Admin!'
            ];
            return redirect()->back()->with('notification', $notification);
        } else {

            $user->status = 'blocked';
            $user->save();
            $notification = [
                'alert' => 'success',
                'message' => 'User Maked Blocked Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function pendingUsers()
    {
        $users = User::role('user')->where('status', 'pending')->get();
        return view("admin.user.pendingUsers", compact("users"));
    }

    public function approvedUsers()
    {
        $users = User::role('user')->where('status', 'approved')->get();
        return view("admin.user.approvedUsers", compact("users"));
    }

    public function blockedUsers()
    {
        $users = User::role('user')->where('status', 'blocked')->get();
        return view("admin.user.blockedUsers", compact("users"));
    }

    public function blockedUser()
    {
        return view('admin.user.block');
    }

    public function pendingUser()
    {
        return view('admin.user.pending');
    }

    public function editProfile()
    {
        $user = User::role('user')->where('id', Auth::user()->id)->first();
        return view('user.partials.editProfile', compact('user'));
    }
    public function changePassword(Request $req, $id)
    {
        $req->validate([
            'password' => 'required|min:6'
        ]);
        $user = User::findOrFail($id);
        $user->password = Hash::make($req->password);
        $user->save();
        return response()->json(['message' => 'Password updated successfully!']);

    }


    public function changeReferral(Request $request, $id)
    {
        $request->validate([
            'referral_name' => 'required|string|unique:users,username',
        ], [
            'referral_name.unique' => 'This referral name is already taken by another user.',
        ]);

        $user = User::findOrFail($id);
        $oldUsername = $user->username;
        $user->username = $request->referral_name;
        $user->save();
        User::where('referral_username', $oldUsername)
            ->update([
                'referral_username' => $request->referral_name,
                'referral_user_id' => $id,
            ]);

        return response()->json(['message' => 'Referral name updated successfully for user and all referrals!']);
    }




}
