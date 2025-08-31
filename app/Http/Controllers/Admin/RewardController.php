<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reward;
use App\Helpers\FileHelper;
use App\Models\RewardDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'reward_title'   => 'required|array|max:255',
            'reward_amount'  => 'required|array|min:0',
            'target_amount'  => 'required|array|min:0',
            'status'         => 'required|in:active,expired,inactive',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'    => 'nullable|string',
        ]);

        DB::beginTransaction();

        $reward = new Reward();
        $reward->title = $request->title;
        $reward->start_date = $request->start_date;
        $reward->end_date = $request->end_date;
        $reward->status = $request->status;
        $reward->description = $request->description;
        $reward->added_by = Auth::user()?->id;

        if ($request->hasFile('image')) {
            $reward->image = FileHelper::upload($request->file('image'), 'assets/admin/uploads/rewards/images');
        }
        
        $reward->save();

        foreach ($request->reward_title as $index => $title) {
            $amount = $request->reward_amount[$index] ?? 0;
            $target = $request->target_amount[$index] ?? 0;

            RewardDetail::create([
                'reward_id'     => $reward->id,
                'reward_title'  => $title,
                'reward_amount' => $amount,
                'target_amount' => $target,
            ]);
        }

        DB::commit();

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
            'reward_title'   => 'required|array|max:255',
            'reward_amount'  => 'required|array|min:0',
            'target_amount'  => 'required|array|min:0',
            'status'         => 'required|in:active,expired,inactive',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'    => 'nullable|string',
        ]);

        DB::beginTransaction();

        $reward = Reward::findOrFail($id);
        $reward->title = $request->title;
        $reward->start_date = $request->start_date;
        $reward->end_date = $request->end_date;
        $reward->status = $request->status;
        $reward->description = $request->description;
        $reward->updated_by = Auth::user()?->id;
        if ($request->hasFile('image')) {
            $reward->image = FileHelper::update(
                $reward->image,
                $request->file('image'),
                'assets/admin/uploads/rewards/images'
            );
        }

        $reward->save();

        foreach ($request->reward_title as $index => $title) {
            $reward->rewardDetails()->delete();
            $amount = $request->reward_amount[$index] ?? 0;
            $target = $request->target_amount[$index] ?? 0;

            RewardDetail::create([
                'reward_id'     => $reward->id,
                'reward_title'  => $title,
                'reward_amount' => $amount,
                'target_amount' => $target,
            ]);
        }

        DB::commit();

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
