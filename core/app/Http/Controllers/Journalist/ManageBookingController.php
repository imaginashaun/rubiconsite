<?php

namespace App\Http\Controllers\Journalist;

use App\Comment;
use App\Expression;
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
        $page_title = "All Work Submissions";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->with('member')->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }
    public function create()
    {
        $user = Auth::user();
        $page_title = "Pitch a Story";
        $services=Service::all();
        return view($this->activeTemplate . 'user.journalist.booking.create', ['page_title'=>$page_title,'services'=>$services]);
    }
    public function StoreBooking
    (Request $request)
    {
        $gnl= GeneralSetting::first();
        $request->validate([
'service_id' => 'required|exists:services,id',
            'title' => 'required|min:1',
            'budget' => 'required|numeric|min:1',
            'delivery_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'description' => 'required|max:5000',
        ]);
        $booking=new Booking;
        $booking->title=$request->title;
        $booking->member_id=1;
        $booking->user_id=Auth::user()->id;
        $booking->service_id=$request->service_id;
        $booking->description=$request->description;
        $booking->delivery_date=$request->delivery_date;
        $booking->budget=$request->budget;
        $booking->order_number = getTrx();
        $booking->working_status = 0;
        $booking->status = 7;
        $booking->save();
        $notify[] = ['success', 'Work Submission has been added'];

        return redirect()->to('user/journalist/booking/my-pending/list')->withNotify($notify);

    }
    public function StoreComment(Request $request){
//        dd($request);
        $comment=new Comment();

        $b=Booking::where('order_number',$request->order_number)->first();
        $comment->comment=$request->comment;
        $comment->booking_id=$b->id;
        $comment->sender='journalist';
        $comment->save();
        $notify[] = ['success', 'Comment has been added'];
        return redirect()->back()->withNotify($notify);

    }



    public function pending()
    {
        $user = Auth::user();
        $page_title = "Pending Work Submissions";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', 0)->where('status', '!=', 0)->where('status', '!=', 7)->where('working_status', 0)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }
    public function mypending()
    {
        $user = Auth::user();
        $page_title = "My Work Submissions";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '=', 7)->where('working_status', 0)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.requests', compact('page_title', 'empty_message', 'booking'));
    }
    public function inprogress()
    {
        $user = Auth::user();
        $page_title = "In progress Work Submissions";
        $empty_message  = "No Data";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 3)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function delivered()
    {
        $user = Auth::user();
        $page_title = "Delivered Work Submissions";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 2)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function complete()
    {
        $user = Auth::user();
        $page_title = "Completed Work Submissions";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 1)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function cancel()
    {
        $user = Auth::user();
        $page_title = "Cancelled Work Submissions";
        $empty_message  = "No Data Found";
        $booking = Booking::where('user_id', $user->id)->where('status', '!=', 0)->where('working_status', 4)->latest()->with('member')->paginate(10);
        return view($this->activeTemplate . 'user.journalist.booking.index', compact('page_title', 'empty_message', 'booking'));
    }

    public function details($order_number)
    {
        $page_title = "Work Submissions Details";
        $booking_details = Booking::where('order_number', $order_number)->with('service')->firstOrFail();

        $expressions = Expression::where('user_id', Auth::user()->id)->get();

        return view($this->activeTemplate . 'user.journalist.booking.details', compact('booking_details', 'page_title', 'expressions'));
    }


    public function express(Request $request)
    {


        $user = Auth::user();
        // $booking = Booking::where('order_number', $request->order_number)->where('user_id', $user->id)->firstOrFail();


        $booking = Booking::where('order_number', $request->order_number)->firstOrFail();
        $expression = new Expression();
        $expression->text = $request->text;
        $expression->user_id = $user->id;
        $expression->booking_id = $booking->id;

        $expression->save();

     //   $booking->working_status = 3;
       // $booking->update();
        $notify[] = ['success', 'Expression of Interest Sent!.'];
        return back()->withNotify($notify);
    }

    public function approvedBy(Request $request)
    {


        $user = Auth::user();
       // $booking = Booking::where('order_number', $request->order_number)->where('user_id', $user->id)->firstOrFail();
        $booking = Booking::where('order_number', $request->order_number)->firstOrFail();

        $booking->working_status = 3;
        $booking->update();
        $notify[] = ['success', 'Work Approved.'];
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
