<?php
namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\Gateway;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Service;
use App\SupportTicket;
use App\Transaction;
use App\User;
use App\UserLogin;
use App\WithdrawMethod;
use App\Withdrawal;
use App\Storie;
use App\Booking;
use App\Employment;
use App\Education;
use App\JournalistWorkFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ManageUsersController extends Controller
{
    public function allUsers()
    {
        $page_title = 'Manage Journalist';
        $empty_message = 'No Journalist found';
        $users = User::where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }


    public function StoreBooking
    (Request $request)
    {
        $gnl= GeneralSetting::first();
        $user = auth()->guard('admin')->user();
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'budget' => 'required|numeric|min:1',
            'delivery_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'description' => 'required|max:5000',
        ]);
//        if($user->balance < $request->budget)
//        {
//            $notify[] = ['error', 'Your Account '. getAmount($user->balance) .' Balance Not Enough! Please Deposit Money'];
//            return back()->withNotify($notify);
//        }


        $booking=new Booking;
        $booking->member_id=$user->id;
        $booking->service_id=$request->service_id;
        $booking->description=$request->description;
        $booking->delivery_date=$request->delivery_date;
        $booking->budget=$request->budget;
        $booking->order_number = getTrx();

        $booking->working_status = 0;
        $booking->status = 1;
        $booking->save();
        $notify[] = ['success', 'Booking has been added'];

//        $transaction = new Transaction();
//        $transaction->user_id = $booking->member_id;
//        $transaction->amount = $booking->budget;
//        $transaction->post_balance = $user->balance;
//        $transaction->trx_type = '-';
//        $transaction->trx = getTrx();
//        $transaction->details = "Payment For journalist Booking";
//        $transaction->save();

//        notify($user, 'BOOKING_PAYMENT', [
//            'order_number' => $booking->order_number,
//            'amount' => getAmount($booking->budget),
//            'currency' => $gnl->cur_text,
//        ]);
        return redirect()->back()->withNotify($notify);

    }

    public function account($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $educations = Education::where('user_id', $user->id)->get();
        $employments = Employment::where('user_id', $user->id)->get();
        $page_title = 'Account Information :' . $user->username;
        $empty_message = 'No Data Found';
        return view('admin.users.account', compact('page_title', 'empty_message', 'user', 'educations', 'employments'));
    }

    public function activeUsers()
    {
        $page_title = 'Manage Active Journalist';
        $empty_message = 'No active Journalist found';
        $users = User::active()->where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function bannedUsers()
    {
        $page_title = 'Banned Journalist';
        $empty_message = 'No banned Journalist found';
        $users = User::banned()->where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $page_title = 'Email Unverified Journalist';
        $empty_message = 'No email unverified Journalist found';
        $users = User::emailUnverified()->where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function emailVerifiedUsers()
    {
        $page_title = 'Email Verified Journalist';
        $empty_message = 'No email verified Journalist found';
        $users = User::emailVerified()->where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }


    public function smsUnverifiedUsers()
    {
        $page_title = 'SMS Unverified Journalist';
        $empty_message = 'No sms unverified Journalist found';
        $users = User::smsUnverified()->where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function smsVerifiedUsers()
    {
        $page_title = 'SMS Verified Journalist';
        $empty_message = 'No sms verified Journalist found';
        $users = User::smsVerified()->where('user_type', 'journalist')->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $users = User::where('user_type', 'journalist')->where(function ($user) use ($search) {
            $user->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('mobile', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
        });
        $page_title = '';
        switch ($scope) {
            case 'active':
                $page_title .= 'Active ';
                $users = $users->where('status', 1);
                break;
            case 'banned':
                $page_title .= 'Banned';
                $users = $users->where('status', 0);
                break;
            case 'emailUnverified':
                $page_title .= 'Email Unerified ';
                $users = $users->where('ev', 0);
                break;
            case 'smsUnverified':
                $page_title .= 'SMS Unverified ';
                $users = $users->where('sv', 0);
                break;
        }
        $users = $users->paginate(getPaginate());
        $page_title .= 'User Search - ' . $search;
        $empty_message = 'No search result found';
        return view('admin.users.list', compact('page_title', 'search', 'scope', 'empty_message', 'users'));
    }


    public function detail($id)
    {
        $page_title = 'Journalist Detail';
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $totalDeposit = Deposit::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalTransaction = Transaction::where('user_id',$user->id)->count();
        $stories['complete'] = Storie::where('user_id', $id)->count();
        $stories['pending'] = Storie::where('user_id', $id)->where('status', 0)->count();
        $video = JournalistWorkFile::whereNotNull('video_file')->where('user_id', $id)->count();
        $audio = JournalistWorkFile::whereNotNull('audio_file')->where('user_id', $id)->count();
        $blog = JournalistWorkFile::whereNotNull('blog_link')->where('user_id', $id)->count();
        $image = JournalistWorkFile::whereNotNull('image')->where('user_id', $id)->count();
        $booking['Pending'] = Booking::where('status', '!=', 0)->where('working_status', 0)->where('user_id', $id)->count();
        $booking['Complete'] = Booking::where('status', '!=', 0)->where('working_status', 1)->where('user_id', $id)->count();
        $booking['Inprogress'] = Booking::where('status', '!=', 0)->where('working_status', 3)->where('user_id', $id)->count();
        $booking['Expired'] = Booking::where('status', '!=', 0)->where('working_status', 6)->where('user_id', $id)->count();
        return view('admin.users.detail', compact('page_title', 'user','totalDeposit','totalWithdraw','totalTransaction', 'video', 'audio', 'blog', 'image', 'stories', 'booking'));
    }


    public function update(Request $request, $id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'email' => 'required|email|max:160|unique:users,email,' . $user->id,
        ]);

        if ($request->email != $user->email && User::whereEmail($request->email)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Email already exists.'];
            return back()->withNotify($notify);
        }
        if ($request->mobile != $user->mobile && User::where('mobile', $request->mobile)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Phone number already exists.'];
            return back()->withNotify($notify);
        }

        $user->mobile = $request->mobile;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = [
                            'address' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'zip' => $request->zip,
                            'country' => $request->country,
                        ];
        $user->status = $request->status ? 1 : 0;
        $user->account_status = $request->account_status ? 1 : 0;
        $user->ev = $request->ev ? 1 : 0;
        $user->sv = $request->sv ? 1 : 0;
        $user->ts = $request->ts ? 1 : 0;
        $user->tv = $request->tv ? 1 : 0;
        $user->save();

        $notify[] = ['success', 'Journalist detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $amount = getAmount($request->amount);
        $general = GeneralSetting::first(['cur_text','cur_sym']);
        $trx = getTrx();

        if ($request->act) {
            $user->balance = bcadd($user->balance, $amount, 8);
            $user->save();
            $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $user->username . ' balance'];


            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = getAmount($user->balance);
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = 'Added Balance Via Admin';
            $transaction->trx =  $trx;
            $transaction->save();


            notify($user, 'BAL_ADD', [
                'trx' => $trx,
                'amount' => $amount,
                'currency' => $general->cur_text,
                'post_balance' => getAmount($user->balance),
            ]);

        } else {
            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . ' has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $user->balance = bcsub($user->balance, $amount, 8);
            $user->save();



            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = getAmount($user->balance);
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Subtract Balance Via Admin';
            $transaction->trx =  $trx;
            $transaction->save();


            notify($user, 'BAL_SUB', [
                'trx' => $trx,
                'amount' => $amount,
                'currency' => $general->cur_text,
                'post_balance' => getAmount($user->balance)
            ]);
            $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $user->username . ' balance'];
        }
        return back()->withNotify($notify);
    }


    public function userLoginHistory($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $page_title = 'Journalist Login History - ' . $user->username;
        $empty_message = 'No Journalist login found.';
        $login_logs = $user->login_logs()->latest()->paginate(getPaginate());
        return view('admin.users.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function showEmailSingleForm($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $page_title = 'Send Email To: ' . $user->username;
        return view('admin.users.email_single', compact('page_title', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        send_general_email($user->email, $request->subject, $request->message, $user->username);
        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function transactions(Request $request, $id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search Journalist Transactions : ' . $user->username;
            $transactions = $user->transactions()->where('trx', $search)->with('user')->latest()->paginate(getPaginate());
            $empty_message = 'No transactions';
            return view('admin.reports.transactions', compact('page_title', 'search', 'user', 'transactions', 'empty_message'));
        }
        $page_title = 'Journalist Transactions : ' . $user->username;
        $transactions = $user->transactions()->with('user')->latest()->paginate(getPaginate());
        $empty_message = 'No transactions';
        return view('admin.reports.transactions', compact('page_title', 'user', 'transactions', 'empty_message'));
    }

    public function storie($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Journalist Stories : ' . $user->username;
        $stories = Storie::where('user_id', $id)->latest()->paginate(getPaginate());
        return view('admin.storie.index', compact('page_title', 'empty_message', 'stories'));
    }

    public function pendingStorie($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Journalist Stories : ' . $user->username;
        $stories = Storie::where('user_id', $id)->where('status', 0)->latest()->paginate(getPaginate());
        return view('admin.storie.index', compact('page_title', 'empty_message', 'stories'));
    }

    public function video($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Journalist Videos Work : ' . $user->username;
        $videos = JournalistWorkFile::whereNotNull('video_file')->where('user_id', $id)->latest()->paginate(getPaginate());
        return view('admin.work.video', compact('page_title', 'empty_message', 'videos'));
    }
    public function audio($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Journalist Audio Work : ' . $user->username;
        $audios = JournalistWorkFile::whereNotNull('audio_file')->where('user_id', $id)->latest()->paginate(getPaginate());
        return view('admin.work.audio', compact('page_title', 'empty_message', 'audios'));
    }
    public function blog($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Journalist Blog Work : ' . $user->username;
        $blogs = JournalistWorkFile::whereNotNull('blog_link')->where('user_id', $id)->latest()->paginate(getPaginate());
        return view('admin.work.blog', compact('page_title', 'empty_message', 'blogs'));
    }
    public function image($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Journalist Image Work : ' . $user->username;
        $images = JournalistWorkFile::whereNotNull('image')->where('user_id', $id)->latest()->paginate(getPaginate());
        return view('admin.work.image', compact('page_title', 'empty_message', 'images'));
    }

    public function bookingPending($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Pending Booking: ' . $user->username;
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 0)->where('user_id', $id)->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function bookingComplete($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Complete Booking: ' . $user->username;
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 1)->where('user_id', $id)->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function bookingInprogress($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'In Progress Booking: ' . $user->username;
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 3)->where('user_id', $id)->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function bookingExpired($id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        $empty_message = "No Data Found";
        $page_title = 'Expired Booking: ' . $user->username;
        $bookings = Booking::where('status', '!=', 0)->where('working_status', 6)->where('user_id', $id)->paginate(getPaginate());
        return view('admin.booking.index', compact('page_title', 'empty_message', 'bookings'));
    }

    public function withdrawals(Request $request, $id)
    {
        $user = User::where('user_type', 'journalist')->where('id', $id)->firstOrFail();
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', 'like',"%$search%")->latest()->paginate(getPaginate());
            $empty_message = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'search', 'withdrawals', 'empty_message'));
        }
        $page_title = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->latest()->paginate(getPaginate());
        $empty_message = 'No withdrawals';
        $userId = $user->id;
        return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'withdrawals', 'empty_message','userId'));
    }

   public  function withdrawalsViaMethod($method,$type,$userId){
        $method = WithdrawMethod::findOrFail($method);
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $page_title = 'Approved Withdrawal of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 1)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $page_title = 'Rejected Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 3)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());

        }elseif($type == 'pending'){
            $page_title = 'Pending Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 2)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());
        }else{
            $page_title = 'Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());
        }
        $empty_message = 'Withdraw Log Not Found';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','method'));
    }

    public function showEmailAllForm()
    {
        $page_title = 'Send Email To All Journalist';
        return view('admin.users.email_all', compact('page_title'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('status', 1)->where('user_type', 'journalist')->cursor() as $user) {
            send_general_email($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function featuredInclude(Request $request)
    {
        $journalist = User::where('id', $request->id)->where('user_type', 'journalist')->firstOrFail();
        $journalist->featured = 1;
        $journalist->update();
        $notify[] = ['success', 'Journalist Featured list Inclued.'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $journalist = User::where('id', $request->id)->where('user_type', 'journalist')->firstOrFail();
        $journalist->featured = 0;
        $journalist->update();
        $notify[] = ['success', 'Journalist Featured list Remove.'];
        return back()->withNotify($notify);
    }

}
