<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\GeneralSetting;
use App\User;
use App\Transaction;
use Carbon\Carbon;

class CronController extends Controller
{
    
    public function cronMethod()
    {
    	$booking = Booking::where('status', '!=', 0)->where('working_status', 0)->get();
        $gnl = GeneralSetting::first();
        foreach ($booking as $key => $value) {
             $user = User::where('id', $value->user_id)->first();
             $now = Carbon::now();
             if($now > $value->delivery_date)
             {
                $value->working_status = 6;
                $value->status = 6;
                $value->update();

                $member = User::findOrFail($value->member_id);
                $member->balance += $value->budget;
                $member->update();
                
                $transaction = new Transaction();
                $transaction->user_id = $value->member_id;
                $transaction->amount = $value->budget;
                $transaction->post_balance = $user->balance;
                $transaction->trx_type = '+';
                $transaction->trx = getTrx();
                $transaction->details = "Balance Refund For This Booking Number " . $value->order_number;
                $transaction->save();
                
                notify($user, 'REFUND_MONEY', [
                    'order_number' => $value->order_number,
                    'amount' => getAmount($value->budget),
                    'currency' => $gnl->cur_text,
                ]);

                $gnl->last_cron_run =  Carbon::now();
                $gnl->update();

              	notify($user, 'BOOKING_DATE_EXPIRED', [
                    'order_number' => $value->order_number,
                    'amount' => getAmount($value->budget),
                    'currency' => $gnl->cur_text,
              	]);
                  
            }
        }
        return 0;
    }
}
