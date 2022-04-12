@php
    $content = getContent('breadcrumb.content', true);
@endphp
    <!-- inner hero start -->
    <section class="inner-hero bg_img background-position-y-top" data-background="{{ getImage('assets/images/frontend/breadcrumb/'. @$content->data_values->image)}}">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h2 class="inner-hero__title text-white">{{__($page_title)}}</h2>
            <ul class="page-breadcrumb justify-content-center">
              <li><a href="{{route('home')}}">@lang('Home')</a> - {{__($page_title)}}</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- inner hero end -->
