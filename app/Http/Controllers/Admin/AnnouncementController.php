<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcement.index', compact('announcements'));
    }

    public function add()
    {
        return view('admin.announcement.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'message'    => 'required|string',
            'link_text'  => 'nullable|string|max:255',
            'link_url'   => 'nullable|url|max:500',
            'order_no'   => 'nullable|integer|min:0',
            'status'     => 'required|in:active,inactive',

        ]);

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->message = $request->message;
        $announcement->link_text = $request->link_text;
        $announcement->link_url = $request->link_url;
        $announcement->status = $request->status;
        $announcement->order_no = $request->order_no;

        $announcement->save();

        $notification = array(
            'messege' => 'Announcement Added Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.announcement.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $request->validate([
            'title'      => 'required|string|max:255',
            'message'    => 'required|string',
            'link_text'  => 'nullable|string|max:255',
            'link_url'   => 'nullable|url|max:500',
            'order_no'   => 'nullable|integer|min:0',
            'status'     => 'required|in:active,inactive',
        ]);
        $announcement = Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->message = $request->message;
        $announcement->link_text = $request->link_text;
        $announcement->link_url = $request->link_url;
        $announcement->status = $request->status;
        $announcement->order_no = $request->order_no;

        $announcement->save();

        $notification = array(
            'messege' => 'Announcement Updated Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.announcement.index')->with('notification', $notification);
    }
    public function delete($id)
    {
        $announcement = Announcement::find($id);
        $announcement->save();
        $announcement->delete();

        $notification = array(
            'messege' => 'Announcement Deleted Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.announcement.index')->with('notification', $notification);
    }

    public function restorePage()
    {

        $announcements = Announcement::onlyTrashed()->get();
        return view('admin.announcement.restore.page', compact('announcements'));
    }

    public function restore($id)
    {
        $announcement = Announcement::withTrashed()->find($id);
        $announcement->restore();

        $notification = array(
            'messege' => 'Announcement Restored Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }

    public function forceDelete($id)
    {
        $announcement = Announcement::withTrashed()->find($id);

        $announcement->forceDelete();

        $notification = array(
            'messege' => 'Announcement Permanently Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}