<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\User;
use App\Booking;
use App\GeneralSetting;
use App\Transaction;
use App\GatewayCurrency;
use App\Deposit;
use Session;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function booking($username)
    {
        $page_title= "Journalist Booking";
        $service = Service::all();
        $user = User::where('username', $username)->firstOrFail();
        return view(activeTemplate().'booking', compact('page_title', 'service', 'user'));
    }

    public function bookingStore(Request $request)
    {
        $gnl= GeneralSetting::first();
        $user = Auth::user();
        $request->validate([
            'journalist_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'budget' => 'required|numeric|min:1',
            'delivery_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'description' => 'required|max:5000',
        ]);
        $journalist = User::where('user_type', 'journalist')->where('id', $request->journalist_id)->firstOrFail();
        if($user->balance < $request->budget)
        {
            $notify[] = ['error', 'Your Account '. getAmount($user->balance) .' Balance Not Enough! Please Deposit Money'];
            return back()->withNotify($notify);
        }
        $booking = new Booking();
        $booking->member_id = $user->id;
        $booking->user_id = $request->journalist_id;
        $booking->budget = $request->budget;
        $booking->service_id = $request->service_id;
        $booking->delivery_date = $request->delivery_date;
        $booking->order_number = getTrx();
        $booking->description = $request->description;
        $booking->working_status = 0;
        $booking->status = 1;
        $booking->save();

        $user->balance -= $booking->budget;
        $user->update();

        $transaction = new Transaction();
        $transaction->user_id = $booking->member_id;
        $transaction->amount = $booking->budget;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type = '-';
        $transaction->trx = getTrx();
        $transaction->details = "Payment For journalist Booking";
        $transaction->save();

        notify($user, 'BOOKING_PAYMENT', [
            'order_number' => $booking->order_number,
            'amount' => getAmount($booking->budget),
            'currency' => $gnl->cur_text,
        ]);
        notify($journalist, 'JOURNALIST_BOOKED', [
            'order_number' => $booking->order_number,
            'amount' => getAmount($booking->budget),
            'currency' => $gnl->cur_text,
        ]);
        $notify[] = ['success', 'Journalist Booking Complete.'];
        return redirect()->route('user.member.booking.list')->withNotify($notify);
    }

}
