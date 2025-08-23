<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $data['announcements'] = Announcement::where('status', 'active')->orderBy('order_no', 'ASC')->get();
        return view('user.dashboard', $data);
    }

    public function editProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.editProfile', compact('user'));
    }

    // public function updateProfile(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'address' => 'nullable',
    //         'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:1024',
    //     ]);

    //     $user = User::find(Auth::user()->id);

    //     if ($request->hasFile('icon')) {

    //         @unlink('admin/user/profile/' . $user->icon);

    //         $file = $request->file('icon');
    //         $extension = $file->getClientOriginalExtension();
    //         $icon = time() . rand() . '.' . $extension;
    //         $file->move('admin/user/profile/', $icon);
    //         $user->icon = $icon;

    //     }

    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->phone_no = $request->phone_no;
    //     $user->whatsapp_no = $request->whatsapp_no;
    //     $user->address = $request->address;

    //     $user->save();

    //     $notification = [
    //         'alert' => 'success',
    //         'message' => 'Profile Updated Successfully!'
    //     ];
    //     return redirect()->back()->with('notification', $notification);
    // }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            // Update the password
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('notification', [
                'alert' => 'success',
                'message' => 'Password Updated Successfully!'
            ]);
        } else {
            return redirect()->back()->with('notification', [
                'alert' => 'warning',
                'message' => 'Current password does not match!'
            ]);
        }
    }
}
