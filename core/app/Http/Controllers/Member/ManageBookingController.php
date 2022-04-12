<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\GeneralSetting;
use App\Transaction;
use App\WorkDelivery;
use App\User;
use Illuminate\Support\Facades\Auth;

class ManageBookingController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $user = Auth::user();
        $page_title = "Journalist Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('member_id', $user->id)->where('status', '!=', 0)->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.member.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function bookingPending()
    {
         $user = Auth::user();
        $page_title = "Journalist Pending Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('member_id', $user->id)->where('status', '!=', 0)->where('working_status', 0)->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.member.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function bookingComplet()
    {
        $user = Auth::user();
        $page_title = "Journalist Complete Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('member_id', $user->id)->where('status', '!=', 0)->where('working_status', 1)->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.member.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function details($order_number)
    {
        $user = Auth::user();
        $data['page_title'] = "Journalist Booking Details";
        $booking_details = Booking::where('order_number', $order_number)->where('member_id', $user->id)->with('service')->firstOrFail();
        return view($this->activeTemplate . 'user.member.booking.details', $data, compact('booking_details'));
    }

    public function workDownload($id)
    {
    
        $page_title = "Work File Download";
        $empty_message = "No Data";
        $work_file_download = WorkDelivery::where('booking_id', $id)->get();
        return view($this->activeTemplate . 'user.member.booking.work_download', compact('page_title', 'empty_message', 'work_file_download'));
          
    }

    public function workFileDownload($id)
    {
        $work_delivery = WorkDelivery::findOrFail($id);
        $location = "assets/work_delivery/";
        $file = $work_delivery->work_file;
        $work_download = $location . $file;
        return response()->download($work_download);
    }

    public function deliveryWorkApproved(Request $request)
    {
        $gnl = GeneralSetting::first();

        $user = Auth::user();
        $booking = Booking::where('order_number', $request->order_number)->where('member_id', $user->id)->firstOrFail();
        $booking->working_status = 1;
        $booking->status = 5;
        $booking->update();

        $charge = ($booking->budget / 100) * $gnl->charge;
        $amount = ($booking->budget - $charge);

        $user = User::findOrFail($booking->user_id);
        $user->balance += $amount;
        $user->update();
        
        $transaction = new Transaction();
        $transaction->user_id = $booking->user_id;
        $transaction->amount = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $charge;
        $transaction->trx_type = '+';
        $transaction->trx = getTrx();
        $transaction->details = "Balance Add For This Booking Number " . $booking->order_number;
        $transaction->save();
        
        notify($user, 'SEND_MONEY', [
            'order_number' => $booking->order_number,
            'amount' => getAmount($booking->budget),
            'currency' => $gnl->cur_text,
        ]);
        $notify[] = ['success', 'Delivery Work Approved.'];
        return back()->withNotify($notify);
    }

    public function workdispute(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'order_number' => 'required|exists:bookings,order_number',
            'report' => 'required|max:500|min:100'
        ]);
        $booking = Booking::where('order_number', $request->order_number)->where('member_id', $user->id)->firstOrFail();
        $booking->working_status =5;
        $booking->status =4;
        $booking->dispute_report = $request->report;
        $booking->update();
        $notify[] = ['success', 'Currently Work Dispute.'];
        return back()->withNotify($notify);
    }

}
