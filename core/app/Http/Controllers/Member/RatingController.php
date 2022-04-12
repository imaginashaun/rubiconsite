<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rating;
use App\Booking;
use App\User;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function rating(Request $request)
    {
        $request->validate([
            'journalist_id' => 'required|exists:users,id',
            'rating' => 'required|max:5|min:1',
        ]);
        $user = Auth::user();
        $booking = Booking::where('user_id', $request->journalist_id)->where('member_id', $user->id)->first();
        if(!$booking)
        {
          $notify[] = ['error', "You are not book this journalist so you can't rating this journalist"];
          return back()->withNotify($notify);
        }
        $rating = new Rating();
        $rating->member_id = $user->id;
        $rating->journalist_id = $request->journalist_id;
        $rating->rating = $request->rating;
        $rating->save();

        $avg_rating = Rating::where('journalist_id', $request->journalist_id)->avg('rating');
        $journalist = User::findOrFail($request->journalist_id);
        $journalist->rating = intval($avg_rating);
        $journalist->update();

        $notify[] = ['success', 'Your Rating Has Been Given'];
        return back()->withNotify($notify);
    }
}
