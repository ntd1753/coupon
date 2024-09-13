<?php

namespace App\Http\Controllers;

use App\Models\Loyalty;
use App\Models\LoyaltyMembership;
use App\Models\LoyaltySetting;
use App\Models\LoyaltyTransaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    public function updateMembership($userId)
    {
        $user = User::findOrFail($userId);
        $totalSpending = $user->orders()->where('status','done')->sum('final_price');

        $membership = LoyaltyMembership::where('spending_required', '<=', $totalSpending)
            ->orderBy('spending_required', 'desc')
            ->first();
        if ($membership) {
            $user->membership_level_id= $membership->id;
            $user->save();
            return response()->json(['success', 'Membership upgraded successfully.']);
        }
        return response()->json(['error', 'No upgrade available for this user.']);

    }
    public function earnPointsFromOrder($orderId)
    {
        // Lấy đơn hàng và thông tin người dùng
        $order = Order::findOrFail($orderId);
        $user = $order->user;

        $pointsPerOrderAmount = config('website.points_per_order_amount');
        $pointsPerUnit = config('website.points_per_unit');

        if (!$pointsPerOrderAmount&&$pointsPerUnit) {
            return response()->json(['message' => 'Order not sufficient for points.'], 400);
        }

        // Kiểm tra xem đơn hàng có đủ điều kiện để tích điểm không
        if ($order->total_price >= $pointsPerOrderAmount) {
            if ($user->membership_level_id){
                $pointsEarned = floor(
                    ($order->total_price / $pointsPerOrderAmount)
                    * $pointsPerUnit
                    * $user->membershipLevel->point_coefficient
                );
            }else{
                $pointsEarned = floor(($order->total_price / $pointsPerOrderAmount) * $pointsPerUnit);
            }
            $loyalty = Loyalty::firstOrCreate(['user_id' => $user->id]);
            $loyalty->increment('point', $pointsEarned);

            $loyaltyTransaction=LoyaltyTransaction::create([
                'user_id' => $user->id,
                'point' => $pointsEarned,
                'type' => 'earned',
                'description' => 'Earned points from order #' . $orderId
            ]);
            return response()->json(['message' => 'Points earned successfully.', 'points' => $pointsEarned], 200);
        } else {
            return response()->json(['message' => 'Order amount not sufficient for points.'], 400);
        }
    }
    public function redeemPoints(Request $request)
    {
        // Lấy user ID và số điểm cần đổi từ request
        $userId = Auth::user()->id;
        $pointsToRedeem = $request->input('points');
        $loyalty = Loyalty::where('user_id', $userId)->first();

        // Kiểm tra người dùng có đủ điểm để đổi không
        if ($loyalty && $loyalty->point >= $pointsToRedeem) {
            $loyalty->decrement('point', $pointsToRedeem);
            LoyaltyTransaction::create([
                'user_id' => $userId,
                'point' => $pointsToRedeem,
                'type' => 'redeemed',
                'description' => 'Redeemed points for reward',
            ]);
            return response()->json(['message' => 'Points redeemed successfully.'], 200);
        } else {
            return response()->json(['error' => 'Not enough points to redeem.'], 400);
        }
    }
}
