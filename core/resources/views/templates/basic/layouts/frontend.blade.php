<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($page_title ?? '') }}</title>
    @include('partials.seo')
    <link rel="icon" type="image/png" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}"
          sizes="16x16">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/lightcase.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/vendor/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/main.css')}}">
    @stack('style-lib')
    @stack('style')

    <link
        href="{{ asset($activeTemplateTrue . 'frontend/css/color.php') }}?color={{$general->base_color}}&color2={{$general->secondary_color}}"
        rel="stylesheet"/>
</head>
<body>
@php echo fbcomment() @endphp
<!--<div class="scroll-to-top">
      <span class="scroll-icon">
        <i class="fa fa-caret-up" aria-hidden="true"></i>
      </span>
</div>-->
<!-- scroll-to-top end -->
<div class="page-wrapper">
    <!-- header-section start  -->
@include($activeTemplate.'partials.header')
<!-- header-section end  -->
    <div class="main-wrapper">
    @yield('content')
    <!-- footer start -->
        @include($activeTemplate.'partials.footer')
    </div>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/lightcase.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/slick.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/wow.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/vendor/apexcharts.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/app.js')}}"></script>

    @stack('script-lib')
    @stack('script')
    @include('partials.plugins')
    @include('admin.partials.notify')

    <script>
        (function ($) {
            "use strict";
            $(document).on("change", ".langSel", function () {
                window.location.href = "{{url('/')}}/change/" + $(this).val();
            });
        })(jQuery);
    </script>
</body>
</html>
