<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('cron', 'CronController@cronMethod')->name('cron');

Route::namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('paypal', 'paypal\ProcessController@ipn')->name('paypal');
    Route::get('paypal_sdk', 'paypal_sdk\ProcessController@ipn')->name('paypal_sdk');
    Route::post('perfect_money', 'perfect_money\ProcessController@ipn')->name('perfect_money');
    Route::post('stripe', 'stripe\ProcessController@ipn')->name('stripe');
    Route::post('stripe_js', 'stripe_js\ProcessController@ipn')->name('stripe_js');
    Route::post('stripe_v3', 'stripe_v3\ProcessController@ipn')->name('stripe_v3');
    Route::post('skrill', 'skrill\ProcessController@ipn')->name('skrill');
    Route::post('paytm', 'paytm\ProcessController@ipn')->name('paytm');
    Route::post('payeer', 'payeer\ProcessController@ipn')->name('payeer');
    Route::post('paystack', 'paystack\ProcessController@ipn')->name('paystack');
    Route::post('voguepay', 'voguepay\ProcessController@ipn')->name('voguepay');
    Route::get('flutterwave/{trx}/{type}', 'flutterwave\ProcessController@ipn')->name('flutterwave');
    Route::post('razorpay', 'razorpay\ProcessController@ipn')->name('razorpay');
    Route::post('instamojo', 'instamojo\ProcessController@ipn')->name('instamojo');
    Route::get('blockchain', 'blockchain\ProcessController@ipn')->name('blockchain');
    Route::get('blockio', 'blockio\ProcessController@ipn')->name('blockio');
    Route::post('coinpayments', 'coinpayments\ProcessController@ipn')->name('coinpayments');
    Route::post('coinpayments_fiat', 'coinpayments_fiat\ProcessController@ipn')->name('coinpayments_fiat');
    Route::post('coingate', 'coingate\ProcessController@ipn')->name('coingate');
    Route::post('coinbase_commerce', 'coinbase_commerce\ProcessController@ipn')->name('coinbase_commerce');
    Route::get('mollie', 'mollie\ProcessController@ipn')->name('mollie');
    Route::post('cashmaal', 'cashmaal\ProcessController@ipn')->name('cashmaal');
});

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});

/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });

    Route::middleware(['admin','access'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::get('password', 'AdminController@password')->name('password');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');


        //Member User MANAGER
        Route::get('member', 'ManageMemberController@allUsers')->name('member.users.all');
        Route::get('member/active', 'ManageMemberController@activeUsers')->name('member.users.active');
        Route::get('member/banned', 'ManageMemberController@bannedUsers')->name('member.users.banned');
        Route::get('member/email-unverified', 'ManageMemberController@emailUnverifiedUsers')->name('member.users.emailUnverified');
        Route::get('member/email-verified', 'ManageMemberController@emailVerifiedUsers')->name('member.users.emailVerified');
        Route::get('member/sms-unverified', 'ManageMemberController@smsUnverifiedUsers')->name('member.users.smsUnverified');

        Route::get('member/{scope}/search', 'ManageMemberController@search')->name('member.users.search');
        Route::get('member/detail/{id}', 'ManageMemberController@detail')->name('member.users.detail');
        Route::post('member/update/{id}', 'ManageMemberController@update')->name('member.users.update');
        Route::post('user/add-sub-balance/{id}', 'ManageMemberController@addSubBalance')->name('member.users.addSubBalance');
        Route::get('member/send-email/{id}', 'ManageMemberController@showEmailSingleForm')->name('member.users.email.single');
        Route::post('member/send-email/{id}', 'ManageMemberController@sendEmailSingle')->name('member.users.email.single');
        Route::get('member/transactions/{id}', 'ManageMemberController@transactions')->name('member.users.transactions');
        Route::get('member/deposits/{id}', 'ManageMemberController@deposits')->name('member.users.deposits');
        Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageMemberController@depViaMethod')->name('member.users.deposits.method');
        Route::get('member/withdrawals/{id}', 'ManageMemberController@withdrawals')->name('member.users.withdrawals');
        Route::get('member/withdrawals/via/{method}/{type?}/{userId}', 'ManageMemberController@withdrawalsViaMethod')->name('member.users.withdrawals.method');
        Route::get('member/booking/{id}', 'ManageMemberController@booking')->name('member.users.booking');

        // Member Login History
        Route::get('member/login/history/{id}', 'ManageMemberController@userLoginHistory')->name('member.users.login.history.single');
        Route::get('member/send-email', 'ManageMemberController@showEmailAllForm')->name('member.users.email.all');
        Route::post('member/send-email', 'ManageMemberController@sendEmailAll')->name('member.users.email.send');


        //journalist Work
        Route::get('journalist/video/work', 'WorkController@video')->name('work.video');
        Route::get('journalist/video/work/detail/{id}', 'WorkController@videoDetail')->name('work.video.detail');
        Route::post('journalist/video/approvedBy', 'WorkController@videoApprovedBy')->name('work.video.approvedBy');
        Route::post('journalist/video/delete', 'WorkController@videoDelete')->name('work.video.delete');
        Route::get('journalist/audio/work', 'WorkController@audio')->name('work.audio');
        Route::get('journalist/audio/work/detail/{id}', 'WorkController@audioDetail')->name('work.audio.detail');
        Route::post('journalist/audio/approvedBy', 'WorkController@audioApprovedBy')->name('work.audio.approvedBy');
        Route::post('journalist/audio/delete', 'WorkController@audioDelete')->name('work.audio.delete');
        Route::get('journalist/blog/work', 'WorkController@blog')->name('work.blog');
        Route::get('journalist/blog/work/detail/{id}', 'WorkController@blogDetail')->name('work.blog.detail');
        Route::post('journalist/blog/approvedBy', 'WorkController@blogApprovedBy')->name('work.blog.approvedBy');
        Route::post('journalist/blog/delete', 'WorkController@blogDelete')->name('work.blog.delete');
        Route::get('journalist/image/work', 'WorkController@image')->name('work.image');
        Route::get('journalist/image/work/detail/{id}', 'WorkController@imageDetail')->name('work.image.detail');
        Route::post('journalist/image/approvedBy', 'WorkController@imageApprovedBy')->name('work.image.approvedBy');
        Route::post('journalist/image/delete', 'WorkController@imageDelete')->name('work.image.delete');


        // Journalist Manager
        Route::get('journalist', 'ManageUsersController@allUsers')->name('users.all');
        Route::get('journalist/account/information/{id}', 'ManageUsersController@account')->name('users.account');
        Route::get('journalist/active', 'ManageUsersController@activeUsers')->name('users.active');
        Route::get('journalist/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
        Route::get('journalist/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
        Route::get('journalist/email-verified', 'ManageUsersController@emailVerifiedUsers')->name('users.emailVerified');
        Route::get('journalist/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
        Route::get('journalist/sms-verified', 'ManageUsersController@smsVerifiedUsers')->name('users.smsVerified');

        Route::get('journalist/{scope}/search', 'ManageUsersController@search')->name('users.search');
        Route::get('journalist/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
        Route::post('journalist/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance');
        Route::post('journalist/update/{id}', 'ManageUsersController@update')->name('users.update');
        Route::get('journalist/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
        Route::post('journalist/send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('users.email.single');
        Route::get('journalist/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
        Route::get('journalist/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
         Route::get('user/withdrawals/via/{method}/{type?}/{userId}', 'ManageUsersController@withdrawalsViaMethod')->name('users.withdrawals.method');

        // Login History
        Route::get('journalist/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');
        Route::get('journalist/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
        Route::post('journalist/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.send');

        // Journalist Work List
        Route::get('journalist/stories/{id}', 'ManageUsersController@storie')->name('users.stories');
        Route::get('journalist/pending/stories/{id}', 'ManageUsersController@pendingStorie')->name('users.pending.stories');
        Route::get('journalist/video/{id}', 'ManageUsersController@video')->name('users.video');
        Route::get('journalist/audio/{id}', 'ManageUsersController@audio')->name('users.audio');
        Route::get('journalist/image/{id}', 'ManageUsersController@image')->name('users.image');
        Route::get('journalist/blog/{id}', 'ManageUsersController@blog')->name('users.blog');

        // Journalist Booking List
        Route::post('journalist/booking/store', 'ManageUsersController@StoreBooking')->name('users.booking.store');
        Route::post('journalist/booking/approve', 'ManageUsersController@ApproveBooking')->name('users.booking.approve');
        Route::post('journalist/booking/comment', 'ManageUsersController@CommentBooking')->name('users.booking.comment');

        Route::get('journalist/booking/pending/{id}', 'ManageUsersController@bookingPending')->name('users.booking.pending');
        Route::get('journalist/booking/complete/{id}', 'ManageUsersController@bookingComplete')->name('users.booking.complete');
        Route::get('journalist/booking/in-progress/{id}', 'ManageUsersController@bookingInprogress')->name('users.booking.inprogress');
        Route::get('journalist/booking/expired/{id}', 'ManageUsersController@bookingExpired')->name('users.booking.expired');


        //Journalist Featured
        Route::post('journalist/featured/inclued', 'ManageUsersController@featuredInclude')->name('journalist.featured.inclued');
        Route::post('journalist/featured/notinclued', 'ManageUsersController@featuredNotInclude')->name('journalist.featured.notinclued');

        //Category
        Route::get('category/list', 'CategoryController@index')->name('category.index');
        Route::post('category/store', 'CategoryController@store')->name('category.store');
        Route::post('category/update', 'CategoryController@update')->name('category.update');

        //Service
        Route::get('service/list', 'ServiceController@index')->name('service.index');
        Route::post('service/store', 'ServiceController@store')->name('service.store');
        Route::post('service/update', 'ServiceController@update')->name('service.update');

        //Journalist Stories
        Route::get('stories/list', 'StoriesController@index')->name('stories.index');
        Route::get('stories/pending', 'StoriesController@pending')->name('stories.pending');
        Route::get('stories/approved', 'StoriesController@approved')->name('stories.approved');
        Route::get('stories/detail/{id}', 'StoriesController@detail')->name('stories.detail');
        Route::post('stories/approvedBy', 'StoriesController@approvedBy')->name('stories.approvedBy');
        Route::post('stories/delete', 'StoriesController@delete')->name('stories.delete');
        Route::get('stories/{scope}/search', 'StoriesController@search')->name('stories.search');


        //Journalist Booking
        Route::get('booking/list', 'BookingController@index')->name('booking.index');
        Route::get('booking/detail/{id}', 'BookingController@details')->name('booking.detail');
        Route::get('booking/pending/list', 'BookingController@pending')->name('booking.pending');
        Route::post('booking/pending-requests/approve', 'BookingController@pending_requests')->name('booking.approve_request');

        Route::get('booking/pending-requests/list', 'BookingController@pending_requests')->name('booking.pending_requests');

        Route::get('booking/complete/list', 'BookingController@complete')->name('booking.complete');
        Route::get('booking/in-progress/list', 'BookingController@inProgress')->name('booking.inprogress');
        Route::get('booking/delivered/list', 'BookingController@delivered')->name('booking.delivered');
        Route::get('booking/dispute/list', 'BookingController@dispute')->name('booking.dispute');
        Route::get('booking/expired/list', 'BookingController@expired')->name('booking.expired');
        Route::get('booking/cancel/list', 'BookingController@cancel')->name('booking.cancel');
        Route::get('booking/{scope}/search', 'BookingController@search')->name('booking.search');
        Route::get('booking/delivery/workFile/download/{id}', 'BookingController@workDeliveryFailDownload')->name('delivery.workFile.download');
        Route::post('send/money/journalist', 'BookingController@sendMoneyJournalist')->name('send.money.journalist');
        Route::post('returned/money/member', 'BookingController@refundMoneyMember')->name('refund.money.member');


        // Deposit Gateway
        Route::name('gateway.')->prefix('gateway')->group(function(){
            // Automatic Gateway
            Route::get('automatic', 'GatewayController@index')->name('automatic.index');
            Route::get('automatic/edit/{alias}', 'GatewayController@edit')->name('automatic.edit');
            Route::post('automatic/update/{code}', 'GatewayController@update')->name('automatic.update');
            Route::post('automatic/remove/{code}', 'GatewayController@remove')->name('automatic.remove');
            Route::post('automatic/activate', 'GatewayController@activate')->name('automatic.activate');
            Route::post('automatic/deactivate', 'GatewayController@deactivate')->name('automatic.deactivate');

            // Manual Methods
            Route::get('manual', 'ManualGatewayController@index')->name('manual.index');
            Route::get('manual/new', 'ManualGatewayController@create')->name('manual.create');
            Route::post('manual/new', 'ManualGatewayController@store')->name('manual.store');
            Route::get('manual/edit/{alias}', 'ManualGatewayController@edit')->name('manual.edit');
            Route::post('manual/update/{id}', 'ManualGatewayController@update')->name('manual.update');
            Route::post('manual/activate', 'ManualGatewayController@activate')->name('manual.activate');
            Route::post('manual/deactivate', 'ManualGatewayController@deactivate')->name('manual.deactivate');
        });


        // DEPOSIT SYSTEM
        Route::name('deposit.')->prefix('deposit')->group(function(){
            Route::get('/', 'DepositController@deposit')->name('list');
            Route::get('pending', 'DepositController@pending')->name('pending');
            Route::get('rejected', 'DepositController@rejected')->name('rejected');
            Route::get('approved', 'DepositController@approved')->name('approved');
            Route::get('successful', 'DepositController@successful')->name('successful');
            Route::get('details/{id}', 'DepositController@details')->name('details');

            Route::post('reject', 'DepositController@reject')->name('reject');
            Route::post('approve', 'DepositController@approve')->name('approve');
            Route::get('via/{method}/{type?}', 'DepositController@depViaMethod')->name('method');
            Route::get('/{scope}/search', 'DepositController@search')->name('search');
            Route::get('date-search/{scope}', 'DepositController@dateSearch')->name('dateSearch');

        });


        // WITHDRAW SYSTEM
        Route::name('withdraw.')->prefix('withdraw')->group(function(){
            Route::get('pending', 'WithdrawalController@pending')->name('pending');
            Route::get('approved', 'WithdrawalController@approved')->name('approved');
            Route::get('rejected', 'WithdrawalController@rejected')->name('rejected');
            Route::get('log', 'WithdrawalController@log')->name('log');
            Route::get('via/{method_id}/{type?}', 'WithdrawalController@logViaMethod')->name('method');
            Route::get('{scope}/search', 'WithdrawalController@search')->name('search');
            Route::get('date-search/{scope}', 'WithdrawalController@dateSearch')->name('dateSearch');
            Route::get('details/{id}', 'WithdrawalController@details')->name('details');
            Route::post('approve', 'WithdrawalController@approve')->name('approve');
            Route::post('reject', 'WithdrawalController@reject')->name('reject');


            // Withdraw Method
            Route::get('method/', 'WithdrawMethodController@methods')->name('method.index');
            Route::get('method/create', 'WithdrawMethodController@create')->name('method.create');
            Route::post('method/create', 'WithdrawMethodController@store')->name('method.store');
            Route::get('method/edit/{id}', 'WithdrawMethodController@edit')->name('method.edit');
            Route::post('method/edit/{id}', 'WithdrawMethodController@update')->name('method.update');
            Route::post('method/activate', 'WithdrawMethodController@activate')->name('method.activate');
            Route::post('method/deactivate', 'WithdrawMethodController@deactivate')->name('method.deactivate');
        });

        // Report
        Route::get('report/member/transaction', 'ReportController@memberTransaction')->name('report.member.transaction');
        Route::get('report/journalist/transaction', 'ReportController@transaction')->name('report.transaction');
        Route::get('report/member/transaction/search', 'ReportController@memberTransactionSearch')->name('report.member.transaction.search');
        Route::get('report/journalist/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');
        Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
        Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');


        // Admin Support
        Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
        Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
        Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
        Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
        Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
        Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');


        // Language Manager
        Route::get('/language', 'LanguageController@langManage')->name('language.manage');
        Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
        Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
        Route::post('/language/update/{id}', 'LanguageController@langUpdatepp')->name('language.manage.update');
        Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
        Route::post('/language/import', 'LanguageController@langImport')->name('language.import_lang');

        Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
        Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
        Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key');


        // General Setting
        Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo_icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo_icon');

        // Plugin
        Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
        Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
        Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
        Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');


        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.sendTestMail');


        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms.template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.global');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.sendTestSMS');

        // SEO
        Route::get('seo', 'FrontendController@seoEdit')->name('seo');


        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {

            Route::get('templates', 'FrontendController@templates')->name('templates');
            Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');

            Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
            Route::post('remove', 'FrontendController@remove')->name('remove');

            // Page Builder
            Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
            Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logoutGet')->name('logout');

    Route::get('register', 'Auth\RegisterController@userType')->name('register');
    Route::get('register/journalist', 'Auth\RegisterController@journalist')->name('register.journalist');
    Route::get('register/member', 'Auth\RegisterController@member')->name('register.member');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('register/{reference}', 'Auth\RegisterController@referralRegister')->name('refer.register');
    });
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code_verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify-code');
});

Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');

        Route::middleware(['checkStatus'])->group(function () {

            // Message Controller
            Route::post('message', 'MesssageController@store')->name('message.store');
            Route::get('inbox', 'MesssageController@inbox')->name('message.inbox');
            Route::get('chat/{conversion_id}', 'MesssageController@chat')->name('message.chat');
            Route::post('message/store', 'MesssageController@messageStore')->name('message.store.list');

            Route::namespace('Member')->middleware('member')->name('member.')->prefix('member')->group(function () {
                // Member Booking Controller
                Route::get('hire/{username}', 'BookingController@booking')->name('booking');
                Route::post('hire/booking/store', 'BookingController@bookingStore')->name('booking.store');

                //Member Dashboard
                Route::get('dashboard', 'MemberController@home')->name('home');
                Route::get('transaction/history', 'MemberController@transaction')->name('transaction.log');
                Route::get('profile', 'MemberController@profile')->name('profile');
                Route::post('profile/update/{user}', 'MemberController@profileUpdate')->name('profile.update');
                Route::get('change-password', 'MemberController@changePassword')->name('change.password');
                Route::post('password/update', 'MemberController@submitPassword')->name('password.update');

                //Member 2FA
                Route::get('twofactor', 'MemberController@show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'MemberController@create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'MemberController@disable2fa')->name('twofactor.disable');

                //Member Withdraw
                Route::get('/withdraw', 'MemberController@withdrawMoney')->name('withdraw');
                Route::post('/withdraw', 'MemberController@withdrawStore')->name('withdraw.money');
                Route::get('/withdraw/preview', 'MemberController@withdrawPreview')->name('withdraw.preview');
                Route::post('/withdraw/preview', 'MemberController@withdrawSubmit')->name('withdraw.submit');
                Route::get('/withdraw/history', 'MemberController@withdrawLog')->name('withdraw.history');
                Route::get('deposit/history', 'MemberController@depositHistory')->name('deposit.history');

                //Member Manage Booking Controller
                Route::get('booking/list', 'ManageBookingController@index')->name('booking.list');
                Route::get('booking/pending/list', 'ManageBookingController@bookingPending')->name('booking.pending.list');
                Route::get('booking/complete/list', 'ManageBookingController@bookingComplet')->name('booking.complete.list');
                Route::post('work/delivery/approved', 'ManageBookingController@deliveryWorkApproved')->name('work.delivery.approved');
                Route::get('booking/detail/{order_number}', 'ManageBookingController@details')->name('booking.detail');
                Route::get('work/download/{id}', 'ManageBookingController@workDownload')->name('work.download');
                Route::get('work/file/download/{id}', 'ManageBookingController@workFileDownload')->name('work.file.download');
                Route::get('work/dispute', 'ManageBookingController@workdispute')->name('work.dispute');
            });

             Route::middleware('member')->name('member.')->prefix('member')->group(function () {

                Route::any('/deposit', 'Gateway\PaymentController@deposit')->name('deposit');
                Route::post('deposit/insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert');
                Route::get('deposit/preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview');
                Route::get('deposit/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');
                Route::get('deposit/manual', 'Gateway\PaymentController@manualDepositConfirm')->name('deposit.manual.confirm');
                Route::post('deposit/manual', 'Gateway\PaymentController@manualDepositUpdate')->name('deposit.manual.update');

                //Rating Controller
                Route::post('rating', 'Member\RatingController@rating')->name('rating');

            });


            Route::namespace('Journalist')->middleware('journalist')->prefix('journalist')->group(function () {

                //Story Controller
                Route::post('delete/storie', 'StoriesController@storieDelete')->name('storie.delete');
                Route::get('storie/index', 'StoriesController@index')->name('storie.index');
                Route::get('storie/create', 'StoriesController@create')->name('storie.create');
                Route::post('storie/store', 'StoriesController@store')->name('storie.store');
                Route::get('storie/{id}/edit', 'StoriesController@edit')->name('storie.edit');
                Route::get('storie/{id}/{slug}', 'StoriesController@details')->name('storie.details');
                Route::post('storie/{id}', 'StoriesController@update')->name('storie.update');

                //Education Controller
                Route::get('education/history', 'EducationController@index')->name('education.list');
                Route::post('education/store', 'EducationController@store')->name('education.store');
                Route::put('education/update', 'EducationController@update')->name('education.update');
                Route::post('education/delete', 'EducationController@delete')->name('education.delete');

                //Employment Controller
                Route::get('employment/list', 'EmploymentController@employment')->name('employment.list');
                Route::post('employment/store', 'EmploymentController@store')->name('employment.store');
                Route::put('employment/update', 'EmploymentController@update')->name('employment.update');
                Route::post('employment/delete', 'EmploymentController@delete')->name('employment.delete');

                // Work File
                Route::get('video-work-list', 'WorkFileController@videoWork')->name('video.work');
                Route::get('video-work/details/{id}', 'WorkFileController@videoDetails')->name('video.work.details');
                Route::post('video/delete', 'WorkFileController@videoDelete')->name('video.delete');

                Route::get('audio-work-list', 'WorkFileController@audioWork')->name('audio.work');
                Route::get('audio-work/details/{id}', 'WorkFileController@audioDetails')->name('audio.work.details');
                Route::post('audio/delete', 'WorkFileController@audioDelete')->name('audio.delete');

                Route::get('image-work-list', 'WorkFileController@imageWork')->name('image.work');
                Route::get('image-work/details/{id}', 'WorkFileController@imageDetails')->name('image.work.details');
                Route::post('image/delete', 'WorkFileController@imageDelete')->name('image.delete');
                Route::get('blog-work-list', 'WorkFileController@blogWork')->name('blog.work');
                Route::get('blog-work/details/{id}', 'WorkFileController@blogDetails')->name('blog.work.details');
                Route::post('blog/delete', 'WorkFileController@blogDelete')->name('blog.delete');
                Route::post('uploade/file', 'WorkFileController@workFile')->name('uploade.work');
                Route::post('uploade/file/update', 'WorkFileController@workFileUpdate')->name('uploade.work.update');
                // Booking

                Route::get('booking/create', 'ManageBookingController@create')->name('journalist.booking.create');
                Route::post('booking/store', 'ManageBookingController@StoreBooking')->name('booking.store');
                Route::post('booking/comment', 'ManageBookingController@StoreComment')->name('booking.comment');

                Route::get('booking/list', 'ManageBookingController@index')->name('journalist.booking.list');
                Route::get('booking/pending/list', 'ManageBookingController@pending')->name('journalist.booking.pending');
                Route::get('booking/my-pending/list', 'ManageBookingController@mypending')->name('journalist.booking.my_pending');

                Route::get('booking/inprogress/list', 'ManageBookingController@inprogress')->name('journalist.booking.inprogress');
                Route::get('booking/delivered/list', 'ManageBookingController@delivered')->name('journalist.booking.delivered');
                Route::get('booking/complete/list', 'ManageBookingController@complete')->name('journalist.booking.complete');
                Route::get('booking/cancel/list', 'ManageBookingController@cancel')->name('journalist.booking.cancel');

                Route::get('booking/details/{order_number}', 'ManageBookingController@details')->name('journalist.booking.details');
                Route::post('booking/approved/update', 'ManageBookingController@approvedBy')->name('journalist.booking.approved.update');
                Route::post('booking/cancel/update', 'ManageBookingController@cancelBy')->name('journalist.booking.cancel.update');

                //Work delivery
                Route::post('work-delivery', 'WorkDeliveryController@workDelivery')->name('journalist.work.delivery');

                // Withdraw
                Route::get('/withdraw', 'UserController@withdrawMoney')->name('withdraw');
                Route::post('/withdraw', 'UserController@withdrawStore')->name('withdraw.money');
                Route::get('/withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
                Route::post('/withdraw/preview', 'UserController@withdrawSubmit')->name('withdraw.submit');
                Route::get('/withdraw/history', 'UserController@withdrawLog')->name('withdraw.history');

                //User Controller
                Route::get('dashboard', 'UserController@home')->name('home');
                Route::get('transaction/history', 'UserController@transaction')->name('transaction.log');
                Route::get('profile-setting', 'UserController@profile')->name('profile-setting');
                Route::post('profile/update/{user}', 'UserController@submitProfile')->name('update.profile');
                Route::get('change-password', 'UserController@changePassword')->name('change-password');
                Route::post('change-password', 'UserController@submitPassword');

                 //2FA
                Route::get('twofactor', 'UserController@show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'UserController@create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'UserController@disable2fa')->name('twofactor.disable');
            });
        });
    });
});

Route::get('/journalist/search', 'SiteController@search')->name('search');
Route::get('/journalist/search/by', 'SiteController@journalistSearch')->name('journalist.searchType');
Route::get('/menu/{slug}/{id}', 'SiteController@footerMenu')->name('footer.menu');
Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit')->name('contact.send');
Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');
Route::get('blog/{id}/{slug}', 'SiteController@blogDetails')->name('blog.details');
Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholderImage');
Route::get('/{slug}', 'SiteController@pages')->name('pages');
Route::get('/', 'SiteController@index')->name('home');
Route::get('/all/stories', 'SiteController@stories')->name('stories');
Route::get('/story/detail/{id}/{slug}', 'SiteController@storyDetails')->name('story.details');
Route::get('/all/journalist', 'SiteController@journalist')->name('journalist');
Route::get('/profile/{username}', 'SiteController@profile')->name('profile');
Route::get('/category/stories/{id}', 'SiteController@categoryStories')->name('category.stories');
Route::get('/journalist/work/details/{id}', 'SiteController@journalistWorkDetails')->name('journalist.work.details');
Route::post('/subscribe', 'SiteController@subscribe')->name('subscribe');

