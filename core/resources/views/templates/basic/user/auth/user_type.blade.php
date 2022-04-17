@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
  $content = getContent('registration_type.content', true);
@endphp

@include($activeTemplate . 'partials.breadcrumb')
    <div class="pt-60 pb-60">
      <div class="container">
        <div class="row justify-content-between mb-none-30">
          <div class="col-lg-3 mb-30">
{{--            <div class="registration-card text-center">--}}
{{--              <div class="registration-card__thumb">--}}
{{--                <img src="{{ getImage('assets/images/frontend/registration_type/'. @$content->data_values->member_background_image,'1280x853')}}" alt="@lang('image')">--}}
{{--              </div>--}}
{{--              <div class="registration-card__content">--}}
{{--                <h3 class="mb-2">{{ __($content->data_values->member_heading) }}</h3>--}}
{{--                <p>{{ __($content->data_values->member_sub_heading) }}</p>--}}
{{--                <a href="{{route('user.register.member')}}" class="cmn-btn mt-4">{{ __($content->data_values->member_btn_name)}}</a>--}}
{{--              </div>--}}
{{--            </div><!-- registration-card end -->--}}
          </div>
          <div class="col-lg-6 mb-30">
            <div class="registration-card text-center">
              <div class="registration-card__thumb">
                <img src="{{ getImage('assets/images/frontend/registration_type/'. @$content->data_values->journalist_background_image,'1280x853')}}" alt="@lang('image')">
              </div>
              <div class="registration-card__content">
                <h3 class="mb-2">{{ __($content->data_values->journalist_heading) }}</h3>
                <p>{{ __($content->data_values->journalist_sub_heading) }}</p>
                <a href="{{route('user.register.journalist')}}" class="cmn-btn mt-4">{{ __($content->data_values->journalist_btn_heading) }}</a>
              </div>
            </div><!-- registration-card end -->
          </div>

            <div class="col-lg-3 mb-30"></div>
        </div>
      </div>
    </div>
@endsection
