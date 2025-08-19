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

class AdminController extends Controller
{

    protected $notificationService;

    // Inject the service through constructor
    public function __construct(RoleNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $users = User::role('admin')->orderBy('id', 'desc')->get();
        return view("admin.admins.index", compact("users"));
    }

    public function add()
    {
        return view("admin.admins.add");
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
            'title' => 'New Admin Created',
            'message' => 'A new user (' . $user->name . ') has been created in the system.',
            'link' => route('admin.admins.index'),
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
            'message' => 'Admin Added Successfuly!'
        );

        return redirect()->route('admin.admins.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("admin.admins.edit", compact("user"));
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
            'message' => 'Admin Updated Successfully!'
        ];

        return redirect()->route('admin.admins.index')->with('notification', $notification);
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
                'message' => 'You Can not Delete Your Admin!'
            ];
            return redirect()->back()->with('notification', $notification);
        } else {

            @unlink('admin/user/profile/' . $user->icon);

            $user->delete();
            $notification = [
                'alert' => 'success',
                'message' => 'Admin Deleted Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function makependingAdmin($id)
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
                'message' => 'Admin Maked Pending Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function makeapprovedAdmin($id)
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
                'message' => 'Admin Maked Approved Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function makeblockedAdmin($id)
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
                'message' => 'Admin Maked Blocked Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function pendingAdmins()
    {
        $users = User::role('admin')->where('status', 'pending')->get();
        return view("admin.admins.pendingAdmins", compact("users"));
    }

    public function approvedAdmins()
    {
        $users = User::role('admin')->where('status', 'approved')->get();
        return view("admin.admins.approvedAdmins", compact("users"));
    }

    public function blockedAdmins()
    {
        $users = User::role('admin')->where('status', 'blocked')->get();
        return view("admin.admins.blockedAdmins", compact("users"));
    }

    public function blockedAdmin()
    {
        return view('admin.admins.block');
    }

    public function pendingAdmin()
    {
        return view('admin.admins.pending');
    }

    public function editProfile()
    {
        $user = User::role('admin')->where('id', Auth::user()->id)->first();
        return view('user.partials.editProfile', compact('user'));
    }
}
