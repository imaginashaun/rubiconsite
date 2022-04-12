
  <header class="header">
    @include($activeTemplate.'partials.topbar')
    <div class="header__bottom">
      <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
          <a class="site-logo site-title" href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="site-logo"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu m-auto">
                <li> <a href="{{route('user.home')}}">@lang('Dashboard')</a></li>
                <li class="menu_has_children"><a href="#0">@lang('Booking')</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('user.journalist.booking.list') }}">@lang('All Booking')</a></li>
                        <li><a href="{{ route('user.journalist.booking.pending') }}">@lang('Pending Booking')</a></li>
                        <li><a href="{{ route('user.journalist.booking.inprogress') }}">@lang('Inprogress Booking')</a></li>
                        <li><a href="{{ route('user.journalist.booking.delivered') }}">@lang('Delivered Booking')</a></li>
                        <li><a href="{{ route('user.journalist.booking.complete') }}">@lang('Complete Booking')</a></li>
                        <li><a href="{{ route('user.journalist.booking.cancel') }}">@lang('Cancel Booking')</a></li>
                    </ul>
                </li>
                <li class="menu_has_children"><a href="#0">@lang('Upload Work')</a>
                    <ul class="sub-menu">
                        <li><a href="{{route('user.video.work')}}">@lang('Video')</a></li>
                        <li><a href="{{route('user.audio.work')}}">@lang('Audio')</a></li>
                        <li><a href="{{route('user.image.work')}}">@lang('Image')</a></li>
                        <li><a href="{{route('user.blog.work')}}">@lang('Blog')</a></li>
                    </ul>
                </li>

                <li class="menu_has_children"><a href="#0">@lang('Stories')</a>
                    <ul class="sub-menu">
                        <li><a href="{{route('user.storie.create')}}">@lang('Add Story')</a></li>
                        <li><a href="{{route('user.storie.index')}}">@lang('All Stories')</a></li>
                    </ul>
                </li>

                <li class="menu_has_children"><a href="#0">@lang('Withdraw')</a>
                    <ul class="sub-menu">
                        <li><a href="{{route('user.withdraw')}}">@lang('Withdraw Money')</a></li>
                        <li><a href="{{route('user.withdraw.history')}}">@lang('Withdraw Log')</a></li>
                    </ul>
                </li>

                <li> <a href="{{route('user.transaction.log')}}">@lang('Transaction')</a></li>

                 <li class="menu_has_children"><a href="#0">@lang('Setting')</a>
                    <ul class="sub-menu">
                        <li><a href="{{route('user.education.list')}}">@lang('Education History')</a></li>
                        <li><a href="{{route('user.employment.list')}}">@lang('Employment History')</a></li>
                    </ul>
                </li>
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
                    <li><a href="{{ route('user.profile-setting') }}"> @lang('Profile Setting')</a></li>
                    <li><a href="{{ route('user.change-password') }}">@lang('Change Password')</a></li>
                    <li><a href="{{ route('user.twofactor') }}"> @lang('2FA Security')</a></li>
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

