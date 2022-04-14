
  <header class="header">
    @include($activeTemplate.'partials.topbar')
    <div class="header__bottom" style="    background: #062c4ec7 !important;">
      <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
          <a class="site-logo site-title" href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="site-logo"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu nav-right" @guest style="position:absolute; right: 0px;"@endguest>
            <!--
              <li> <a href="{{ route('home') }}">@lang('Home')</a></li>
              @foreach($pages as $k => $data)
                  <li><a href="{{route('pages',[$data->slug])}}" >{{__(trans($data->name))}}</a></li>
              @endforeach
              <li> <a href="{{ route('stories') }}">@lang('Stories')</a></li>
              <li> <a href="{{ route('journalist') }}">@lang('Journalist')</a></li>
              <li><a href="{{route('contact')}}" >@lang('Contact')</a></li>
                -->

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

                @guest

                    <li><a href="{{route('user.register.journalist')}}">@lang('Register')</a></li>

                    <li><a href="{{ route('user.login') }}">@lang('Login')</a></li>
                @endguest
            </ul>


          </div>
        </nav>
      </div>
    </div><!-- header__bottom end -->
  </header>

