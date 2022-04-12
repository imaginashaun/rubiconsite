@php
    $socials = getContent('social_icon.element');
    $footerMenus = getContent('footer.element');
@endphp
</div><!-- main-wrapper end --> 
<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 text-lg-left text-center mb-lg-0 mb-3">
                    <a href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="site-logo"></a>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="short-menu-list d-flex flex-wrap justify-content-lg-center justify-content-md-start justify-content-center align-items-center">
                        @forelse($footerMenus as $footerMenu)
                            <li><a href="{{route('footer.menu', [str_slug($footerMenu->data_values->menu_name), $footerMenu->id])}}">{{$footerMenu->data_values->menu_name}}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <ul class="social-links d-flex flex-wrap justify-content-md-end justify-content-center align-items-center">
                        @forelse($socials as $social)
                            <li><a href="{{$social->data_values->url}}" target="_blank">@php echo $social->data_values->icon @endphp</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <hr>
                    <p class="copy-right-text text-white text-center">@lang('Copyright') © {{Carbon\Carbon::now()->year}} | @lang('All Right Reserved')</p>
                </div>
            </div>
        </div>
    </div>
</footer>