<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Transaction;
use App\WorkDelivery;
use App\GeneralSetting;


class BookingController extends Controller
{

    public function index()
    {
        $page_title = "All Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function details($id)
    {
        $page_title = "Booking Details";
        $booking = Booking::findOrFail($id);
        return view('admin.booking.detail', compact('page_title', 'booking'));
    }

    public function pending()
    {
        $page_title = "Pending Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', 1)->where('working_status', 0)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function pending_requests()
    {
        $page_title = "Journalist Pending Booking Requests List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', 7)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.requests', compact('page_title', 'empty_message', 'bookings'));
    }



    public function complete()
    {
        $page_title = "Complete Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 1)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function inProgress()
    {
        $page_title = "In progress Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 3)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function delivered()
    {
        $page_title = "Delivered Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 2)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function cancel()
    {
        $page_title = "Cancel Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 4)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function dispute()
    {
        $page_title = "Dispute Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 5)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function expired()
    {
        $page_title = "Expired Booking List";
        $empty_message = "No Data Found";
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 6)->latest()->with('member', 'journalist')->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $bookings = Booking::where('status', '!=', 0)
                ->where(function($q) use ($search){
                    $q->where('order_number', $search)
                    ->OrwhereHas('member', function($user) use ($search){
                        $user->where('username', $search);
                    })
                    ->OrwhereHas('journalist', function($user) use ($search){
                        $user->where('username', $search);
                    });
                });
        $page_title = '';
        switch ($scope) {
            case 'pending':
                $page_title .= 'Pending ';
                $bookings = $bookings->where('working_status', 0);
                break;
            case 'completed':
                $page_title .= 'Completed ';
                $bookings = $bookings->where('working_status', 1);
                break;
            case 'delivered':
                $page_title .= 'Delivered ';
                $bookings = $bookings->where('working_status', 2);
                break;
            case 'inprogress':
                $page_title .= 'In Progress ';
                $bookings = $bookings->where('working_status', 3);
                break;
            case 'cancel':
                $page_title .= 'Cancel ';
                $bookings = $bookings->where('working_status', 4);
                break;
             case 'dispute':
                $page_title .= 'Dispute ';
                $bookings = $bookings->where('working_status', 5);
                break;
            case 'expired':
                $page_title .= 'Expired ';
                $bookings = $bookings->where('working_status', 6);
                break;
        }
        $bookings = $bookings->latest()->paginate(getPaginate());
        $page_title .= 'Service Order Search - ' . $search;
        $empty_message = 'No search result found';
        return view('admin.booking.index', compact('page_title', 'search', 'scope', 'empty_message', 'bookings'));
    }


    public function sendMoneyJournalist(Request $request)
    {
        $gnl = GeneralSetting::first();
        $request->validate([
            'id' => 'required|exists:bookings,id',
        ]);
        $booking = Booking::find($request->id);
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
        $notify[] = ['success', 'Journalist Send Money Complete.'];
        return back()->withNotify($notify);
    }

    public function refundMoneyMember(Request $request)
    {
        $gnl = GeneralSetting::first();
        $request->validate([
            'id' => 'required|exists:bookings,id',
        ]);
        $booking = Booking::findOrFail($request->id);
        $booking->status = 6;
        $booking->update();

        $user = User::findOrFail($booking->member_id);
        $user->balance += $booking->budget;
        $user->update();

        $transaction = new Transaction();
        $transaction->user_id = $booking->member_id;
        $transaction->amount = $booking->budget;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type = '+';
        $transaction->trx = getTrx();
        $transaction->details = "Balance Refund For This Booking Number " . $booking->order_number;
        $transaction->save();

        notify($user, 'REFUND_MONEY', [
            'order_number' => $booking->order_number,
            'amount' => getAmount($booking->budget),
            'currency' => $gnl->cur_text,
        ]);
        $notify[] = ['success', 'Member Refund Money Send Successfully.'];
        return back()->withNotify($notify);
    }

    public function workDeliveryFailDownload($id)
    {
        $work_delivery = WorkDelivery::findOrFail($id);
        $location = "assets/work_delivery/";
        $file = $work_delivery->work_file;
        $work_download = $location . $file;
        return response()->download($work_download);
    }
}
