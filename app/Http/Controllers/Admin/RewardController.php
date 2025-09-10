<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reward;
use App\Helpers\FileHelper;
use App\Models\RewardDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Investment;
use App\Models\User;
use App\Models\UserReturn;
use App\Models\UserLedger;
use App\Models\UserTotal;
use App\Models\RewardHistory;

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
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reward_title' => 'required|array|max:255',
            'reward_amount' => 'required|array|min:0',
            'target_amount' => 'required|array|min:0',
            'status' => 'required|in:active,expired,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
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
                'reward_id' => $reward->id,
                'reward_title' => $title,
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
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reward_title' => 'required|array|max:255',
            'reward_amount' => 'required|array|min:0',
            'target_amount' => 'required|array|min:0',
            'status' => 'required|in:active,expired,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
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
                'reward_id' => $reward->id,
                'reward_title' => $title,
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


    // In your calculateRewardForAllReferrals function, modify to check payment status
    public function calculateRewardForAllReferrals()
    {
        $rewardLists = [];
        $reward = Reward::where("status", 'active')->first();

        if (!$reward) {
            return view("admin.reward.rewarded-user", compact("rewardLists"));
        }

        $users = User::whereHas("investments")->get();

        foreach ($users as $user) {
            $totalReferralAmount = Investment::where('referral_id', $user->id)
                ->where('status', 'approved')
                ->where("expiry_date", '>=', today())
                ->where("is_active", "active")
                ->whereBetween("approved_at", [$reward->start_date, $reward->end_date])
                ->sum('amount');

            $rewardDetail = RewardDetail::whereHas('reward', function ($q) {
                $q->where('status', 'active');
            })
                ->where('target_amount', '<=', $totalReferralAmount)
                ->orderByDesc('target_amount')
                ->first();
            if ($rewardDetail) {
                $alreadyPaid = RewardHistory::where('user_id', $user->id)
                    ->where('reward_id', $reward->id)
                    ->where('reward_name', $rewardDetail->reward_title)
                    ->exists();

                $rewardLists[] = [
                    'user_id' => $user->id,
                    'user_name' => $user->username,
                    'total_referral_investment' => $totalReferralAmount,
                    'reward' => $rewardDetail->reward_title,
                    'reward_amount' => $rewardDetail->reward_amount,
                    'reward_title' => $rewardDetail->reward->title ?? "N/A",
                    'paid' => $alreadyPaid, // Add payment status
                    'paid_date' => $alreadyPaid ? RewardHistory::where('user_id', $user->id)
                        ->where('reward_id', $reward->id)
                        ->where('reward_name', $rewardDetail->reward_title)
                        ->first()->pay_date : null,
                ];
            }
        }

        return view("admin.reward.rewarded-user", compact("rewardLists"));
    }
    public function adminPayReward(Request $request)
    {
        $request->validate([
            'user_name' => 'required|exists:users,username',
            'reward_amount' => 'required|numeric|min:1',
            'reward_title' => 'nullable|string',
        ]);
        $user = User::where('username', $request->user_name)->firstOrFail();
        $amount = $request->reward_amount;
        try {
            DB::transaction(function () use ($user, $amount, $request) {
                $reward = Reward::where("status", "active")->first();

                $rewardDetail = null;
                if ($reward && $request->reward_title) {
                    $rewardDetail = RewardDetail::where("reward_id", $reward->id)
                        ->where("reward_title", $request->reward_title)
                        ->first();
                }
                $userReturn = UserReturn::create([
                    'user_id' => $user->id,
                    'amount' => $amount,
                    'entry_date' => now()->toDateString(),
                    'type' => 'reward',
                ]);
                UserLedger::create([
                    'user_id' => $user->id,
                    'user_return_id' => $userReturn->id,
                    'type' => 'reward',
                    'amount' => $amount,
                    'balance_before' => $user->net_balance,
                    'balance_after' => $user->net_balance + $amount,
                    'description' => 'Reward credited',
                ]);
                $totals = UserTotal::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'total_invested' => 0,
                        'total_referral_commission' => 0,
                        'total_salaries' => 0,
                        'total_rewards' => 0,
                        'total_withdraws' => 0,
                        'total_fee' => 0,
                        'direct_count' => 0,
                    ]
                );
                $totals->increment('total_rewards', $amount);
                $user->increment('net_balance', $amount);
                RewardHistory::create([
                    'user_id' => $user->id,
                    'reward_id' => $reward?->id,
                    'reward_title' => $reward?->title ?? "N/A",
                    'reward_name' => $rewardDetail?->reward_title ?? "Manual Reward",
                    'reward_amount' => $amount,
                    'pay_date' => now()->toDateString(),
                ]);
            });


            $notification = [
                'message' => "Reward of {$amount} credited to {$user->username}",
                'alert' => 'success',
            ];
            return redirect()->back()->with('notification', $notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Transaction failed: " . $e->getMessage());
        }
    }
}






