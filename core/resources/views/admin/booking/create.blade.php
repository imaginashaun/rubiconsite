@extends('admin.layouts.app')
@section('panel')
    <section class="pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
{{--                    <div class="booking-journalist has-link base--bg text-white mb-4">--}}
{{--                        <a href="{{ route('profile', $user->username) }}" class="item-link"></a>--}}
{{--                        <div class="thumb"><img src="{{ getImage('assets/images/user/profile/'. $user->image, '350x300')}}" alt="image"></div>--}}
{{--                        <h6 class="name">{{ $user->username }}</h6>--}}
{{--                    </div>--}}
                    <div class="booking-wrapper">
                        <form class="booking-form" action="{{ route('user.member.booking.store') }}" method="POST">
                            @csrf
{{--                            <input type="hidden" name="journalist_id" value="{{$user->id}}">--}}
                            <h4 class="mb-4">@lang('Booking Request')</h4>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="delivery_date">@lang('Delivery Date')</label>
                                    <input type="text" name="delivery_date" id="delivery_date" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ date('Y-m-d') }}" placeholder="@lang('Select Date')" autocomplete="off" required="">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="budget" class="ml-3">@lang('What is Your Budget')</label>
                                    <div class="col-auto">
                                        <label class="sr-only" for="inlineFormInputGroup">@lang('Username')</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                            </div>
                                            <input type="text" name="budget" id="budget" placeholder="@lang('Amount')" value="{{ old('budget') }}" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="service_id">@lang('Service Type')</label>
                                    <select id="service_id" name="service_id" required="">
                                        <option selected disabled>@lang('Select Service')</option>
{{--                                        @forelse ($service as $key => $value)--}}
{{--                                            <option value="{{ $value->id }}">{{ $value->name }}</option>--}}
{{--                                        @empty--}}

{{--                                        @endforelse--}}
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="description">@lang('Description')</label>
                                    <textarea placeholder="@lang('Description')" name="description" id="description" class="form-control" required="">{{ old('description')}}</textarea>
                                </div>
                                <div class="col-lg-12">
                                </div>
                                <button type="submit" class="btn pay-btn btn-block">@lang('Pay Now')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/datepicker.min.css') }}">
@endpush
@push('script-lib')
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        'use strict';
        (function($){
            $('.datepicker-here').datepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                minDate: new Date(),
                autoClose: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
        })(jQuery)
    </script>
@endpush
