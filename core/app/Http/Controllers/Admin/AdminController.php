<?php

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\Gateway;
use App\User;
use App\UserLogin;
use App\Withdrawal;
use App\WithdrawMethod;
use Carbon\Carbon;
use App\Booking;
use App\JournalistWorkFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function dashboard()
    {
        $page_title = 'Dashboard';

        // Journalist Info
        $widget['total_users'] = User::where('user_type', 'journalist')->count();
        $widget['verified_users'] = User::where('user_type', 'journalist')->where('status', 1)->count();
        $widget['email_unverified_users'] = User::where('user_type', 'journalist')->where('ev', 0)->count();
        $widget['sms_unverified_users'] = User::where('user_type', 'journalist')->where('sv', 0)->count();

        // Member Info
        $member['total_users'] = User::where('user_type', 'member')->count();
        $member['verified_users'] = User::where('user_type', 'member')->where('status', 1)->count();
        $member['email_unverified_users'] = User::where('user_type', 'member')->where('ev', 0)->count();
        $member['sms_unverified_users'] = User::where('user_type', 'member')->where('sv', 0)->count();

        //Booking Info
        $booking['pending'] = Booking::where('status', '!=', 0)->where('working_status', 0)->count();
        $booking['inprogress'] = Booking::where('status', '!=', 0)->where('working_status', 3)->count();
        $booking['delivered'] = Booking::where('status', '!=', 0)->where('working_status', 2)->count();
        $booking['complete'] = Booking::where('status', '!=', 0)->where('working_status', 1)->count();

        //Journalist Work
        $work['video'] = JournalistWorkFile::whereNotNull('video_file')->count();
        $work['audio'] = JournalistWorkFile::whereNotNull('audio_file')->count();
        $work['blog'] = JournalistWorkFile::whereNotNull('blog_link')->count();
        $work['image'] = JournalistWorkFile::whereNotNull('image')->count();

        // Monthly Deposit & Withdraw Report Graph
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);

        $depositsMonth = Deposit::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();

        $depositsMonth->map(function ($aaa) use ($report) {
            $report['months']->push($aaa->months);
            $report['deposit_month_amount']->push(getAmount($aaa->depositAmount));
        });

        $withdrawalMonth = Withdrawal::whereYear('created_at', '>=', Carbon::now()->subYear())->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();
        $withdrawalMonth->map(function ($bb) use ($report){
            $report['withdraw_month_amount']->push(getAmount($bb->withdrawAmount));
        });


        // Withdraw Graph
        $withdrawal = Withdrawal::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)
            ->select(array(DB::Raw('sum(amount)   as totalAmount'), DB::Raw('DATE(created_at) day')))
            ->groupBy('day')->get();
        $withdrawals['per_day'] = collect([]);
        $withdrawals['per_day_amount'] = collect([]);
        $withdrawal->map(function ($a) use ($withdrawals) {
            $withdrawals['per_day']->push(date('d M', strtotime($a->day)));
            $withdrawals['per_day_amount']->push($a->totalAmount + 0);
        });


        // user Browsing, Country, Operating Log
        $user_login_data = UserLogin::whereDate('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);


        $payment['total_deposit_amount'] = Deposit::where('status',1)->sum('amount');
        $payment['total_deposit_charge'] = Deposit::where('status',1)->sum('charge');
        $payment['total_deposit_pending'] = Deposit::where('status',2)->count();
        $payment['total_deposit'] = Deposit::where('status',1)->count();

        $paymentWithdraw['total_withdraw_amount'] = Withdrawal::where('status',1)->sum('amount');
        $paymentWithdraw['total_withdraw'] = Withdrawal::where('status',1)->count();
        $paymentWithdraw['total_withdraw_charge'] = Withdrawal::where('status',1)->sum('charge');
        $paymentWithdraw['total_withdraw_pending'] = Withdrawal::where('status',2)->count();


        $latestUser = User::where('user_type', 'journalist')->latest()->limit(6)->get();
        $empty_message = 'User Not Found';

        return view('admin.dashboard', compact('page_title', 'widget', 'report', 'withdrawals', 'chart','payment','paymentWithdraw','latestUser','empty_message', 'member', 'booking', 'work', 'withdrawalMonth', 'depositsMonth'));
    }


    public function profile()
    {
        $page_title = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('page_title', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $user = Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = uploadImage($request->image, imagePath()['profile']['admin']['path'], imagePath()['profile']['admin']['size'], $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('admin.profile')->withNotify($notify);
    }


    public function password()
    {
        $page_title = 'Password Setting';
        $admin = Auth::guard('admin')->user();
        return view('admin.password', compact('page_title', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password Do not match !!'];
            return back()->withErrors(['Invalid old password.']);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password Changed Successfully.'];
        return redirect()->route('admin.password')->withNotify($notify);
    }


}
