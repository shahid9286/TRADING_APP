<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    public function adminNotification()
    {

        $notifications = auth()->user()->unreadNotifications;

        return view('admin.notification.allNotification', compact('notifications'));
    }

    public function admin_Notify_MarkRead(Request $request)
    {

        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    public function adminNotify_Mark_all_Read()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('admin.profile.editprofile', compact('user'));
    }
    public function user_Notify_MarkRead(Request $request)
    {

        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    public function userNotify_Mark_all_Read()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('admin.profile.editprofile', compact('user'));
    }
}
