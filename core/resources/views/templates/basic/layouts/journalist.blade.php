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
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/lightcase.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/vendor/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'journalist/css/main.css')}}">
    @stack('style-lib')
    @stack('style')

    <link
        href="{{ asset($activeTemplateTrue . 'journalist/css/color.php') }}?color={{$general->base_color}}&color2={{$general->secondary_color}}"
        rel="stylesheet"/>
</head>
<body>
@php echo fbcomment() @endphp
<div class="scroll-to-top">
      <span class="scroll-icon">
        <i class="fa fa-rocket" aria-hidden="true"></i>
      </span>
</div>
<!-- scroll-to-top end -->
<div class="page-wrapper">
    <!-- header-section start  -->
@include($activeTemplate.'partials.journalist_header')
<!-- header-section end  -->
    <div class="main-wrapper">
    @yield('content')
    <!-- footer start -->
        @include($activeTemplate.'partials.footer')
    </div>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/lightcase.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/slick.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/wow.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/vendor/apexcharts.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'journalist/js/app.js')}}"></script>

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
