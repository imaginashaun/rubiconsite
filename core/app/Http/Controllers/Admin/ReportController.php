<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\UserLogin;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function memberTransaction()
    {
        $page_title = 'Member Transaction Logs';
        $transactions = Transaction::with('user')->whereHas('user', function($q){
            $q->where('user_type', 'member');
        })->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No transactions.';
        return view('admin.reports.memberTransactions', compact('page_title', 'transactions', 'empty_message')); 
    }

    public function transaction()
    {
        $page_title = 'Journalist Transaction Logs';
        $transactions = Transaction::with('user')->whereHas('user', function($q){
            $q->where('user_type', 'journalist');
        })->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function memberTransactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Member Transactions Search - ' . $search;
        $empty_message = 'No transactions.';
        $transactions = Transaction::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('user_type', 'member');
            $user->where('username', 'like',"%$search%");
        })->orWhere('trx', $search)
        ->whereHas('user', function($q){
            $q->where('user_type', 'member');
        })->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.reports.memberTransactions', compact('page_title', 'transactions', 'empty_message'));
    }


    public function transactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Transactions Search - ' . $search;
        $empty_message = 'No transactions.';
        $transactions = Transaction::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('user_type', 'journalist');
            $user->where('username', 'like',"%$search%");
        })->orWhere('trx', $search)->whereHas('user', function($q){
            $q->where('user_type', 'journalist');
        })->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function loginHistory(Request $request)
    {
        if ($request->search) {
            $search = $request->search;
            $page_title = 'User Login History Search - ' . $search;
            $empty_message = 'No search result found.';
            $login_logs = UserLogin::whereHas('user', function ($query) use ($search) {
                $query->where('username', $search);
            })->orderBy('id','desc')->paginate(getPaginate());
            return view('admin.reports.logins', compact('page_title', 'empty_message', 'search', 'login_logs'));
        }
        $page_title = 'User Login History';
        $empty_message = 'No users login found.';
        $login_logs = UserLogin::orderBy('id','desc')->paginate(getPaginate());
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function loginIpHistory($ip)
    {
        $page_title = 'Login By - ' . $ip;
        $login_logs = UserLogin::where('user_ip',$ip)->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No users login found.';
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));

    }
}
