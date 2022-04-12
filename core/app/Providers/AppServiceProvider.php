<?php

namespace App\Providers;

use App\GeneralSetting;
use App\Language;
use App\Page;
use App\User;
use App\Extension;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $activeTemplate = activeTemplate();

        $viewShare['general'] = GeneralSetting::first();
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['language'] = Language::all();
        $viewShare['pages'] = Page::where('tempname',$activeTemplate)->where('slug','!=','home')->get();
        view()->share($viewShare);
        

        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'banned_users_count'           => User::banned()->where('user_type', 'journalist')->count(),
                'email_unverified_users_count' => User::emailUnverified()->where('user_type', 'journalist')->count(),
                'sms_unverified_users_count'   => User::smsUnverified()->where('user_type', 'journalist')->count(),
                'banned_member_count'           => User::banned()->where('user_type','member')->count(),
                'email_unverified_member_count' => User::emailUnverified()->where('user_type', 'member')->count(),
                'sms_unverified_member_count'   => User::smsUnverified()->where('user_type', 'member')->count(),
                'pending_ticket_count'         => \App\SupportTicket::whereIN('status', [0,2])->count(),
                'pending_deposits_count'    => \App\Deposit::pending()->count(),
                'pending_withdraw_count'    => \App\Withdrawal::pending()->count(),
                'pending_stories_count'    => \App\Storie::where('status', 0)->count(),
                'pending_journalist_work_count'    => \App\JournalistWorkFile::where('status', 0)->count(),
                'pending_journalist_video_count'    => \App\JournalistWorkFile::whereNotNull('video_file')->where('status', 0)->count(),
                'pending_journalist_audio_count'    => \App\JournalistWorkFile::whereNotNull('audio_file')->where('status', 0)->count(),
                'pending_journalist_blog_count'    => \App\JournalistWorkFile::whereNotNull('blog_link')->where('status', 0)->count(),
                'pending_journalist_image_count'    => \App\JournalistWorkFile::whereNotNull('image')->where('status', 0)->count(),
                'booking_complete_count'    => \App\Booking::where('working_status', 5)->where('status', 4)->count()
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = \App\Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

    }
}
