@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('contact_us.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')

<section class="pt-60 pb-60">
  <div class="container">
    <div class="contact-wrapper">
      <div class="row">
        <div class="col-lg-6 contact-thumb bg_img" data-background="{{ getImage('assets/images/frontend/contact_us/'. $content->data_values->image, '1280x853')}}"></div>
        <div class="col-lg-6 contact-form-wrapper">
          <h2 class="font-weight-bold">{{ __($content->data_values->title) }}</h2>
          <span>{{ __($content->data_values->short_details) }}</span>
          <form class="contact-form mt-4" action="" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-lg-6">
                <input type="text" name="name" placeholder="@lang('Full Name')" class="form-control">
              </div>
              <div class="form-group col-lg-6">
                <input type="email" name="email" placeholder="@lang('Email Address')" class="form-control">
              </div>
              <div class="form-group col-lg-12">
                <input type="text" name="subject" placeholder="@lang('Subject')" class="form-control">
              </div>
              <div class="form-group col-lg-12">
                <textarea class="form-control" name="message" placeholder="@lang('Message')"></textarea>
              </div>
              <div class="col-lg-12">
                <button type="submit" class="cmn-btn">@lang('Send Message')</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="map-section pb-120 mb-1650-80">
  <div class="map-shape">
      <img src="{{ getImage('assets/images/frontend/contact_us/'. $content->data_values->background_image)}}" alt="contact">
  </div>
  <div class="container">
      <div class="row align-items-center justify-content-between">
          <div class="col-xl-7">
              <div class="contact-area">
                  <div class="contact-item">
                      <div class="contact-inner">
                          <div class="thumb">
                              <i class="flaticon-address"></i>
                          </div>
                          <div class="content">
                              <h6 class="title">@lang('office address')</h6>
                              <ul>
                                  <li>{{ __($content->data_values->contact_address) }}</li>
                              </ul>
                          </div>
                      </div>
                      <div class="contact-inner">
                          <div class="thumb">
                              <i class="flaticon-mail-1"></i>
                          </div>
                          <div class="content">
                              <h6 class="title">@lang('Email address')</h6>
                              <ul>
                                  <li>
                                      <a href="mailto:{{ $content->data_values->email_address }}">{{ __($content->data_values->email_address) }}</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="contact-item">
                      <div class="contact-inner">
                          <div class="thumb">
                              <i class="flaticon-whatsapp"></i>
                          </div>
                          <div class="content">
                              <h6 class="title">@lang('phone number')</h6>
                              <ul>
                                  <li>
                                      <a href="tel:{{ $content->data_values->contact_number }}">{{ $content->data_values->contact_number }}</a>
                                  </li>

                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-5 pl-xxl-100">
              <div class="maps"></div>
          </div>
      </div>
  </div>
</section>
@endsection
@push('script-lib')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCo_pcAdFNbTDCAvMwAD19oRTuEmb9M50c"></script>
    <script src="{{asset($activeTemplateTrue . 'frontend/js/vendor/map.js')}}"></script>
@endpush

@push('script')
<script>
  'use strict';
  (function($){
    var mapOptions = {
      center: new google.maps.LatLng({{ $content->data_values->latitude }}, {{ $content->data_values->longitude }}),
      zoom: 7,
      styles: styleArray,
      scrollwheel: false,
      backgroundColor: '#001b83',
      mapTypeControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementsByClassName("maps")[0],
      mapOptions);
    var myLatlng = new google.maps.LatLng(43.874936, 50.385821);
    var focusplace = {lat: 55.864237, lng: -4.251806};
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      icon: {
        url: "assets/frontend/images/map-marker.png"
      }
    })
  })(jQuery)
</script>
@endpush
