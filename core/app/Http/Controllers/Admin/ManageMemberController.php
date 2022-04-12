<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deposit;
use App\GeneralSetting;
use App\SupportTicket;
use App\Transaction;
use App\User;
use App\WithdrawMethod;
use App\UserLogin;
use App\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Booking;

class ManageMemberController extends Controller
{
  public function allUsers()
  {
      $page_title = 'All Members List';
      $empty_message = 'No Member Found';
      $member_users = User::latest()->where('user_type', 'member')->paginate(getPaginate());
      return view('admin.member_user.list', compact('page_title', 'empty_message', 'member_users'));
  }

  public function activeUsers()
  {
      $page_title = 'Active Members';
      $empty_message = 'No active Member found';
      $member_users = User::active()->where('user_type', 'member')->latest()->paginate(getPaginate());
      return view('admin.member_user.list', compact('page_title', 'empty_message', 'member_users'));
  }

  public function bannedUsers()
  {
      $page_title = 'Banned Members';
      $empty_message = 'No banned Member found';
      $member_users = User::banned()->where('user_type', 'member')->latest()->paginate(getPaginate());
      return view('admin.member_user.list', compact('page_title', 'empty_message', 'member_users'));
  }

  public function emailUnverifiedUsers()
  {
      $page_title = 'Email Unverified Members';
      $empty_message = 'No email unverified Member found';
      $member_users = User::emailUnverified()->where('user_type', 'member')->latest()->paginate(getPaginate());
      return view('admin.member_user.list', compact('page_title', 'empty_message', 'member_users'));
  }
  public function emailVerifiedUsers()
  {
       $page_title = 'Email Verified Members';
       $empty_message = 'No email verified user found';
       $member_users = User::emailVerified()->where('user_type', 'member')->latest()->paginate(getPaginate());
       return view('admin.member_user.list', compact('page_title', 'empty_message', 'member_users'));
  }

  public function smsUnverifiedUsers()
  {
      $page_title = 'SMS Unverified Members';
      $empty_message = 'No sms unverified Members found';
      $member_users = User::smsUnverified()->where('user_type', 'member')->latest()->paginate(getPaginate());
      return view('admin.member_user.list', compact('page_title', 'empty_message', 'member_users'));
  }


  public function search(Request $request, $scope)
  {
      $search = $request->search;
      $users = User::where('user_type', 'member')->where(function ($user) use ($search) {
          $user->where('username', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('mobile', 'like', "%$search%")
              ->orWhere('full_names', 'like', "%$search%");
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
      $member_users = $users->paginate(getPaginate());
      $page_title .= 'Member Search - ' . $search;
      $empty_message = 'No search result found';
      return view('admin.member_user.list', compact('page_title', 'search', 'scope', 'empty_message', 'member_users'));
  }


  public function detail($id)
  {
      $page_title = 'Member User Detail';
      $member_users = User::where('user_type', 'member')->where('id', $id)->firstOrFail();;
      $totalDeposit = Deposit::where('user_id', $member_users->id)->where('status',1)->sum('amount');
      $totalWithdraw = Withdrawal::where('user_id',$member_users->id)->where('status',1)->sum('amount');
      $totalTransaction = Transaction::where('user_id', $member_users->id)->count();
      $totalBooking = Booking::where('member_id', $id)->where('status', '!=', 0)->count();
      return view('admin.member_user.detail', compact('page_title', 'member_users','totalDeposit','totalTransaction',
       'totalBooking','totalWithdraw'));
  }

  public function update(Request $request, $id)
  {
     $user = User::where('id', $id)->where('user_type', 'member')->firstOrFail();
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
      $user->website = $request->website ? $request->website : null;
      $user->address = [
                          'address' => $request->address,
                          'city' => $request->city,
                          'state' => $request->state,
                          'zip' => $request->zip,
                          'country' => $request->country,
                      ];
      $user->status = $request->status ? 1 : 0;
      $user->ev = $request->ev ? 1 : 0;
      $user->sv = $request->sv ? 1 : 0;
      $user->ts = $request->ts ? 1 : 0;
      $user->tv = $request->tv ? 1 : 0;
      $user->save();

      $notify[] = ['success', 'Member detail has been updated'];
      return redirect()->back()->withNotify($notify);
  }

  public function addSubBalance(Request $request, $id)
  {
      $request->validate(['amount' => 'required|numeric|gt:0']);
      $member_users = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      $amount = getAmount($request->amount);
      $general = GeneralSetting::first(['cur_text','cur_sym']);
      $trx = getTrx();

      if ($request->act) {
          $member_users->balance = bcadd($member_users->balance, $amount, 8);
          $member_users->save();
          $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $member_users->username . ' balance'];


          $transaction = new Transaction();
          $transaction->user_id = $member_users->id;
          $transaction->amount = $amount;
          $transaction->post_balance = getAmount($member_users->balance);
          $transaction->charge = 0;
          $transaction->trx_type = '+';
          $transaction->details = 'Added Balance Via Admin';
          $transaction->trx =  $trx;
          $transaction->save();


          notify($member_users, 'BAL_ADD', [
              'trx' => $trx,
              'amount' => $amount,
              'currency' => $general->cur_text,
              'post_balance' => getAmount($member_users->balance),
          ]);

      } else {
          if ($amount > $member_users->balance) {
              $notify[] = ['error', $member_users->username . ' has insufficient balance.'];
              return back()->withNotify($notify);
          }
          $member_users->balance = bcsub($member_users->balance, $amount, 8);
          $member_users->save();



          $transaction = new Transaction();
          $transaction->user_id = $member_users->id;
          $transaction->amount = $amount;
          $transaction->post_balance = getAmount($member_users->balance);
          $transaction->charge = 0;
          $transaction->trx_type = '-';
          $transaction->details = 'Subtract Balance Via Admin';
          $transaction->trx =  $trx;
          $transaction->save();

          notify($member_users, 'BAL_SUB', [
              'trx' => $trx,
              'amount' => $amount,
              'currency' => $general->cur_text,
              'post_balance' => getAmount($member_users->balance)
          ]);
          $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $member_users->email . ' balance'];
      }
      return back()->withNotify($notify);
  }


  public function UserLoginHistory($id)
  {
      $member_users = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      $page_title = 'Members Login History - ' . $member_users->email;
      $empty_message = 'No Members login found.';
      $login_logs = $member_users->login_logs()->latest()->paginate(getPaginate());
      return view('admin.member_user.logins', compact('page_title', 'empty_message', 'login_logs'));
  }

  public function loginHistory(Request $request)
  {
      if ($request->search) {
          $search = $request->search;
          $page_title = 'Members Login History Search - ' . $search;
          $empty_message = 'No search result found.';
          $login_logs = UserLogin::whereHas('user', function ($query) use ($search) {
              $query->where('user_type', 'member');
              $query->where('username', $search);
              $query->where('user_type', 'company');
          })->latest()->paginate(getPaginate());
          return view('admin.member_user.logins', compact('page_title', 'empty_message', 'search', 'login_logs'));
      }
      $page_title = 'Members Login History';
      $empty_message = 'No Members login found.';
      $login_logs = UserLogin::whereHas('user', function($q){
          $q->where('user_type', 'member');
      })->latest()->paginate(getPaginate());
      return view('admin.member_user.logins', compact('page_title', 'empty_message', 'login_logs'));
  }

  public function loginIpHistory($ip)
  {
      $page_title = 'Login By - ' . $ip;
      $login_logs = UserLogin::where('user_ip',$ip)->latest()->paginate(getPaginate());
      $empty_message = 'No Member login found.';
      return view('admin.member_user.logins', compact('page_title', 'empty_message', 'login_logs'));

  }

  public function showEmailSingleForm($id)
  {
      $member_users = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      $page_title = 'Send Email To: ' . $member_users->username;
      return view('admin.member_user.email_single', compact('page_title', 'member_users'));
  }

  public function sendEmailSingle(Request $request, $id)
  {
      $request->validate([
          'message' => 'required|string|max:65000',
          'subject' => 'required|string|max:190',
      ]);
      $member_users = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      send_general_email($member_users->email, $request->subject, $request->message, $member_users->member_name);
      $notify[] = ['success', $member_users->username . ' will receive an email shortly.'];
      return back()->withNotify($notify);
  }

  public function transactions(Request $request, $id)
  {
      $user = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      if ($request->search) {
          $search = $request->search;
          $page_title = 'Search User Transactions : ' . $user->username;
          $transactions = $user->transactions()->where('trx', $search)->with('user')->latest()->paginate(getPaginate());
          $empty_message = 'No transactions';
          return view('admin.reports.memberTransactions', compact('page_title', 'search', 'user', 'transactions', 'empty_message'));
      }
      $page_title = 'Member User Transactions : ' . $user->username;
      $transactions = $user->transactions()->with('user')->latest()->paginate(getPaginate());
      $empty_message = 'No transactions';
      return view('admin.reports.memberTransactions', compact('page_title', 'user', 'transactions', 'empty_message'));
  }

  public function deposits(Request $request, $id)
  {
     
      $user = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      $userId = $user->id;
      if ($request->search) {
          $search = $request->search;
          $page_title = 'Search User Deposits : ' . $user->username;
          $deposits = $user->deposits()->where('trx', $search)->latest()->paginate(getPaginate());
          $empty_message = 'No deposits';
          return view('admin.deposit.log', compact('page_title', 'search', 'user', 'deposits', 'empty_message'));
      }

      $page_title = 'Member User Deposit : ' . $user->username;
      $deposits = $user->deposits()->latest()->paginate(getPaginate());
      $empty_message = 'No deposits';
      return view('admin.deposit.log', compact('page_title', 'user', 'deposits', 'empty_message', 'userId'));
  }


   public function depViaMethod($method,$type = null,$userId){

        $method = Gateway::where('alias',$method)->firstOrFail();        
        $user = User::where('user_type', 'member')->where('id', $userId);
        if ($type == 'approved') {
            $page_title = 'Approved Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 1)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $page_title = 'Rejected Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 3)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'successful'){
            $page_title = 'Successful Payment Via '.$method->name;
            $deposits = Deposit::where('status', 1)->where('user_id',$user->id)->where('method_code',$method->code)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'pending'){
            $page_title = 'Pending Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 2)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }else{
            $page_title = 'Payment Via '.$method->name;
            $deposits = Deposit::where('status','!=',0)->where('user_id',$user->id)->where('method_code',$method->code)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }
        $page_title = 'Deposit History: '.$user->username.' Via '.$method->name;
        $methodAlias = $method->alias;
        $empty_message = 'Deposit Log';
        return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits','methodAlias','userId'));
    }


  public function booking($id)
  {
    $user = User::findOrFail($id);
    $page_title = 'Member Booking: ' . $user->username;
    $empty_message = 'Member Booking Not Found: ' . $user->username;
    $bookings = Booking::where('member_id', $id)
                        ->where('status', '!=', 0)
                        ->paginate(getPaginate());
    return view('admin.booking.index', compact('page_title', 'bookings', 'empty_message'));
  }

  public function withdrawals(Request $request, $id)
  {
      $user = User::where('user_type', 'member')->where('id', $id)->firstOrFail();
      $userId = $user->id;
      if ($request->search) {
          $search = $request->search;
          $page_title = 'Search Members Withdrawals : ' . $user->username;
          $withdrawals = $user->withdrawals()->where('trx', 'like',"%$search%")->latest()->paginate(getPaginate());
          $empty_message = 'No withdrawals';
          return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'search', 'withdrawals', 'empty_message'));
      }
      $page_title = 'Member User Withdrawals : ' . $user->username;
      $withdrawals = $user->withdrawals()->latest()->paginate(getPaginate());
      $empty_message = 'No withdrawals';
      return view('admin.withdraw.member_withdrawals', compact('page_title', 'user', 'withdrawals', 'empty_message', 'userId'));
  }

    public  function withdrawalsViaMethod($method,$type,$userId){
        $method = WithdrawMethod::findOrFail($method);
        $user = User::findOrFail($userId);
        $userId = $user->id;
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
        return view('admin.withdraw.member_withdrawals', compact('page_title', 'withdrawals', 'empty_message','method', 'userId'));
    }

  public function showEmailAllForm()
  {
      $page_title = 'Send Email To All Members';
      return view('admin.member_user.email_all', compact('page_title'));
  }

  public function sendEmailAll(Request $request)
  {
      $request->validate([
          'message' => 'required|string|max:65000',
          'subject' => 'required|string|max:190',
      ]);

      foreach (User::where('status', 1)->where('user_type', 'member')->cursor() as $user) {
          send_general_email($user->email, $request->subject, $request->message, $user->username);
      }

      $notify[] = ['success', 'All Member users will receive an email shortly.'];
      return back()->withNotify($notify);
  }
}
