<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\UserProfile;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $user = User::with('profile')->findOrFail(Auth::id());
        return view('admin.user.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email'        => 'required|email|unique:users,email,' . Auth::id(),
            'phone'        => 'nullable|string|max:20',
            'whatsapp_no'  => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:500',
            'profile_image'=> 'nullable|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $user = User::findOrFail(Auth::id());
        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        $user->name     = $request->first_name . ' ' . $request->last_name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->save();

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image && file_exists(public_path('admin/user/profile/' . $profile->profile_image))) {
                @unlink(public_path('admin/user/profile/' . $profile->profile_image));
            }
            $file = $request->file('profile_image');
            $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/user/profile/'), $filename);
            $profile->profile_image = $filename;
        }

        $profile->first_name  = $request->first_name;
        $profile->last_name   = $request->last_name;
        $profile->whatsapp_no = $request->whatsapp_no;
        $profile->address     = $request->address;
        $profile->save();

        return redirect()->back()->with('notification', [
            'alert'   => 'success',
            'message' => 'Profile Updated Successfully!'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password'     => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('notification', [
                'alert'   => 'success',
                'message' => 'Password Updated Successfully!'
            ]);
        }

        return redirect()->back()->with('notification', [
            'alert'   => 'warning',
            'message' => 'Current password does not match!'
        ]);
    }
}
