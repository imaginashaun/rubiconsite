<?php

namespace App\Http\Controllers\Journalist;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use App\Booking;
use App\Transaction;
use App\GeneralSetting;
use Carbon\Carbon;
use App\User;
use App\Rating;
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
        $page_title = "Booking All List";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->with('member')->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }
    public function create()
    {
        $user = Auth::user();
        $page_title = "Post Booking";
        $service=Service::all();
        return view($this->activeTemplate . 'user.journalist.booking.create', compact('page_title'));
    }
    public function StoreBooking
    (Request $request)
    {
        $gnl= GeneralSetting::first();
        $request->validate([
//'service_id' => 'required|exists:services,id',
            'budget' => 'required|numeric|min:1',
            'delivery_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'description' => 'required|max:5000',
        ]);
        $booking=new Booking;
        $booking->member_id=1;
        $booking->user_id=Auth::user()->id;
        $booking->service_id=1;
        $booking->description=$request->description;
        $booking->delivery_date=$request->delivery_date;
        $booking->budget=$request->budget;
        $booking->order_number = getTrx();
        $booking->working_status = 0;
        $booking->status = 0;
        $booking->save();
        $notify[] = ['success', 'Booking request has been added'];

        return redirect()->to('user/journalist/booking/pending/list')->withNotify($notify);

    }


    public function pending()
    {
        $user = Auth::user();
        $page_title = "Booking Pending List";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 0)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function inprogress()
    {
        $user = Auth::user();
        $page_title = "Booking Inprogress List";
        $empty_message  = "No Data";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 3)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function delivered()
    {
        $user = Auth::user();
        $page_title = "Booking Delivered List";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 2)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function complete()
    {
        $user = Auth::user();
        $page_title = "Booking Completed List";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 1)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function cancel()
    {
        $user = Auth::user();
        $page_title = "Booking Cancel List";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 4)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function details($order_number)
    {
        $page_title = "Journalist Booking Details";
        $booking_details = Booking::where('order_number', $order_number)->with('service')->firstOrFail();
        return view($this->activeTemplate . 'user.journalist.booking.details', compact('booking_details', 'page_title'));
    }

    public function approvedBy(Request $request)
    {
        $user = Auth::user();
        $booking = Booking::where('order_number', $request->order_number)->where('user_id', $user->id)->firstOrFail();
        $booking->working_status = 3;
        $booking->update();
        $notify[] = ['success', 'Booking Approved.'];
        return back()->withNotify($notify);
    }

    public function cancelBy(Request $request)
    {
        $gnl = GeneralSetting::first();
        $user = Auth::user();
        $booking = Booking::where('order_number', $request->order_number)->where('user_id', $user->id)->firstOrFail();
        $booking->working_status = 4;
        $booking->status = 6;
        $booking->update();

        $member = User::findOrFail($booking->member_id);
        $member->balance += $booking->budget;
        $member->update();

        $transaction = new Transaction();
        $transaction->user_id = $booking->member_id;
        $transaction->amount = $booking->budget;
        $transaction->post_balance = $member->balance;
        $transaction->trx_type = '+';
        $transaction->trx = getTrx();
        $transaction->details = "Balance Refund For This Booking Number " . $booking->order_number;
        $transaction->save();

        notify($member, 'REFUND_MONEY', [
            'order_number' => $booking->order_number,
            'amount' => getAmount($booking->budget),
            'currency' => $gnl->cur_text,
        ]);
        $notify[] = ['success', 'Booking Cancel.'];
        return back()->withNotify($notify);
    }

}
