
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
              <li> <a href="{{ route('home') }}">@lang('Home')</a></li>
              @foreach($pages as $k => $data)
                  <li><a href="{{route('pages',[$data->slug])}}" >{{__(trans($data->name))}}</a></li>
              @endforeach
              <li> <a href="{{ route('stories') }}">@lang('Stories')</a></li>
              <li> <a href="{{ route('journalist') }}">@lang('Journalist')</a></li>
              <li><a href="{{route('contact')}}" >@lang('Contact')</a></li>

              @auth
                @if(auth()->user()->user_type == "member")
                  <li class="menu_has_children"><a href="#">{{auth()->user()->username}}</a>
                      <ul class="sub-menu">
                          <li><a href="{{route('user.member.home')}}">@lang('Dashboard')</a></li>
                          <li><a href="{{route('user.logout')}}">@lang('Logout')</a></li>
                      </ul>
                  </li>
                @elseif(auth()->user()->user_type == "journalist")
                  <li class="menu_has_children"><a href="#">{{auth()->user()->username}}</a>
                      <ul class="sub-menu">
                          <li><a href="{{route('user.home')}}">@lang('Dashboard')</a></li>
                          <li><a href="{{route('user.logout')}}">@lang('Logout')</a></li>
                      </ul>
                  </li>
                @endif
              @endauth
            </ul>
            @guest
              <div class="nav-right">
                <ul class="account-menu ml-3">
                    <li class="icon"><i class="las la-user"></i>
                      <ul class="account-submenu">
                        <li><a href="{{ route('user.login') }}">@lang('Login')</a></li>
                        <li><a href="{{route('user.register')}}">@lang('Registration')</a></li>
                      </ul>
                    </li>
                </ul>
              </div>
            @endguest

          </div>
        </nav>
      </div>
    </div><!-- header__bottom end -->
  </header>

