<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\EnquiryComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::all();
        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function add()
    {
        return view('admin.enquiry.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone_no' => 'required',
            'subject' => 'nullable',
            'enquiry_message' => 'required',
            'status' => 'required',
            'followup_date' => 'nullable',
            'followup_type' => 'required',
            'remarks' => 'nullable',

        ]);

        $enquiry = new Enquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone_no = $request->phone_no;
        $enquiry->subject = $request->subject;
        $enquiry->enquiry_message = $request->enquiry_message;
        $enquiry->status = $request->status;
        $enquiry->followup_date = $request->followup_date;
        $enquiry->followup_type = $request->followup_type;
        $enquiry->remarks = $request->remarks;

        $enquiry->save();

        $notification = array(
            'message' => 'Enquiry Added Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.enquiry.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('admin.enquiry.edit', compact('enquiry'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone_no' => 'required',
            'subject' => 'nullable',
            'enquiry_message' => 'required',
            'status' => 'required',
            'followup_date' => 'nullable',
            'followup_type' => 'required',
            'remarks' => 'nullable',

        ]);

        $enquiry = Enquiry::find($id);
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone_no = $request->phone_no;
        $enquiry->subject = $request->subject;
        $enquiry->enquiry_message = $request->enquiry_message;
        $enquiry->status = $request->status;
        $enquiry->followup_date = $request->followup_date;
        $enquiry->followup_type = $request->followup_type;
        $enquiry->remarks = $request->remarks;

        $enquiry->save();

        $notification = array(
            'message' => 'Enquiry Updated Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.enquiry.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $enquiry = Enquiry::find($id);

        $enquiry->delete();

        $notification = array(
            'message' => 'Enquiry Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
    public function detail($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $comments = $enquiry->enquiryComments->groupBy(function ($comment) {
            return Carbon::parse($comment->created_at)->format('Y-m-d');
        });
        return view('admin.enquiry.detail', compact('enquiry', 'comments'));
    }
    public function comment(Request $request, $id) 
    {
        $request->validate([
            'comment' => 'required|max:500',
        ], [
            'comment.required' => 'Please enter a comment.',
            'comment.max' => 'The comment must not exceed 500 characters.',
        ]);


        $comment = new EnquiryComment();

        $comment->comment = $request->comment;
        $comment->enquiry_id = $id;
        $comment->user_id = Auth::id();
        $comment->updated_at = NULL;

        $comment->save();

        $notification = array(
            'message' => 'Comment Added Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
    public function deleteComment($id)
    {
        $comment = EnquiryComment::find($id);
        if ($comment) {
            $comment->delete();

            $notification = array(
                'message' => 'Comment Deleted Successfully!',
                'alert' => 'success',
            );

            return back()->with('notification', $notification);
        } else {

            $notification = array(
                'message' => 'Comment Not Found!',
                'alert' => 'warning',
            );

            return back()->with('notification', $notification);
        }
    }


    public function restorePage()
    {

        $enquiries = Enquiry::onlyTrashed()->get();
        return view('admin.enquiry.restore', compact('enquiries'));
    }

    public function restore($id)
    {
        $enquiry = Enquiry::withTrashed()->find($id);
        $enquiry->restore();

        $notification = array(
            'message' => 'Enquiry Restored Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }

    public function forceDelete($id)
    {
        $enquiry = Enquiry::withTrashed()->find($id);

        $enquiry->forceDelete();

        $notification = array(
            'message' => 'Enquiry Permanently Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}
