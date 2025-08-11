<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reward;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('admin.reward.index', compact('rewards'));
    }

    public function add()
    {
        return view('admin.reward.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'reward_title'   => 'required|string|max:255',
            'reward_amount'  => 'required|numeric|min:0',
            'target_amount'  => 'required|numeric|min:0',
            'status'         => 'required|in:active,expired,inactive',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'    => 'nullable|string',
        ]);

        $rewards = new Reward();
        $rewards->title = $request->title;
        $rewards->start_date = $request->start_date;
        $rewards->end_date = $request->end_date;
        $rewards->reward_title = $request->reward_title;
        $rewards->reward_amount = $request->reward_amount;
        $rewards->target_amount = $request->target_amount;
        $rewards->status = $request->status;
        $rewards->description = $request->description;
        $rewards->added_by = Auth::user()?->id;

            if ($request->hasFile('image')) {
            $rewards->image = FileHelper::upload($request->file('image'), 'assets/admin/uploads/rewards/images');
        }

        $rewards->save();

        $notification = array(
            'message' => 'Reward Added Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.reward.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        return view('admin.reward.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'reward_title'   => 'required|string|max:255',
            'reward_amount'  => 'required|numeric|min:0',
            'target_amount'  => 'required|numeric|min:0',
            'status'         => 'required|in:active,expired,inactive',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'    => 'nullable|string',
        ]);

        $rewards = Reward::findOrFail($id);
        $rewards->title = $request->title;
        $rewards->start_date = $request->start_date;
        $rewards->end_date = $request->end_date;
        $rewards->reward_title = $request->reward_title;
        $rewards->reward_amount = $request->reward_amount;
        $rewards->target_amount = $request->target_amount;
        $rewards->status = $request->status;
        $rewards->description = $request->description;
         $rewards->updated_by = Auth::user()?->id;
        if ($request->hasFile('image')) {
            $rewards->image = FileHelper::update(
                $rewards->image,
                $request->file('image'),
                'assets/admin/uploads/rewards/images'
            );
        }

        $rewards->save();

        $notification = array(
            'message' => 'Reward Updated Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.reward.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $rewards = Reward::find($id);

        $rewards->delete();

        $notification = array(
            'message' => 'Reward Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
    public function restorePage()
    {

        $rewards = Reward::onlyTrashed()->get();
        return view('admin.reward.restore', compact('rewards'));
    }

    public function restore($id)
    {
        $rewards = Reward::withTrashed()->find($id);
        $rewards->restore();

        $notification = array(
            'message' => 'Reward Restored Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }

    public function forceDelete($id)
    {
        $rewards = Reward::withTrashed()->find($id);

        $rewards->forceDelete();

        $notification = array(
            'message' => 'Reward Permanently Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}
