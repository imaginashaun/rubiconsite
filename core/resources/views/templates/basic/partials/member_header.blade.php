<header class="header">
    @include($activeTemplate.'partials.topbar')
    <div class="header__bottom" style="  background: #062c4ec7 !important;">
      <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
          <a class="site-logo site-title" href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="site-logo"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu m-auto">
                <li> <a href="{{route('user.member.home')}}">@lang('Dashboard')</a></li>
                <li> <a href="{{route('user.member.booking.list')}}">@lang('Booking List')</a></li>
                <li class="menu_has_children"><a href="#0">@lang('Deposit')</a>
                    <ul class="sub-menu">
                        <li><a href="{{route('user.member.deposit')}}">@lang('Deposit Money')</a></li>
                        <li><a href="{{route('user.member.deposit.history')}}">@lang('Deposit History')</a></li>
                    </ul>
                </li>
                <li class="menu_has_children"><a href="#0">@lang('Withdraw')</a>
                    <ul class="sub-menu">
                        <li><a href="{{route('user.member.withdraw')}}">@lang('Withdraw Money')</a></li>
                        <li><a href="{{route('user.member.withdraw.history')}}">@lang('Withdraw History')</a></li>
                    </ul>
                </li>

                <li> <a href="{{route('user.member.transaction.log')}}">@lang('Transaction Log')</a></li>
                <li> <a href="{{route('ticket')}}">@lang('Get Support')</a></li>

            </ul>
            <div class="nav-right">
              <ul class="account-menu ml-3">
                <li class="icon">
                  <div class="rounded-author-icon d-none d-xl-block">
                    <img src="{{ getImage('assets/images/user/profile/'. auth()->user()->image ?? '')}}" alt="Member Image" />
                  </div>
                  <ul class="account-submenu">
                    <li><a href="{{ route('user.message.inbox') }}"> @lang('Inbox')</a></li>
                    <li><a href="{{ route('user.member.profile') }}"> @lang('Profile Setting')</a></li>
                    <li><a href="{{ route('user.member.change.password') }}">@lang('Change Password')</a></li>
                    <li><a href="{{ route('user.member.twofactor') }}"> @lang('2FA Security')</a></li>
                    <li><a href="{{ route('user.logout')}}">@lang('Logout')</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div><!-- header__bottom end -->
  </header>

