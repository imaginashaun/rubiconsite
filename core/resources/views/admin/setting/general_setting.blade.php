@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Site Title') </label>
                                    <input class="form-control form-control-lg" type="text" name="sitename" value="{{$general->sitename}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Currency')</label>
                                    <input class="form-control form-control-lg" type="text" name="cur_text" value="{{$general->cur_text}}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Currency Symbol') </label>
                                    <input class="form-control form-control-lg" type="text" name="cur_sym" value="{{$general->cur_sym}}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Site Charge') </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-lg" name="charge" value="{{getAmount($general->charge)}}" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-control-label font-weight-bold"> @lang('Site Base Color')</label>
                                <div class="input-group">
                                <span class="input-group-addon ">
                                    <input type='text' class="form-control form-control-lg colorPicker" value="{{$general->base_color}}"/>
                                </span>
                                    <input type="text" class="form-control form-control-lg colorCode" name="base_color" value="{{ $general->base_color }}"/>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label font-weight-bold"> @lang('Site Secondary Color')</label>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <input type='text' class="form-control form-control-lg colorPicker" value="{{$general->secondary_color}}"/>
                                </span>
                                    <input type="text" class="form-control form-control-lg colorCode" name="secondary_color" value="{{ $general->secondary_color }}"/>
                                </div>
                            </div>

                            <div class="form-group col">
                                <label class="form-control-label font-weight-bold">@lang('User Registration')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="registration" @if($general->registration) checked @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold"> @lang('Email Verification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="ev" @if($general->ev) checked @endif>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">@lang('Email Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="en" @if($general->en) checked @endif>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold"> @lang('SMS Verification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="sv" @if($general->sv) checked @endif>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">@lang('SMS Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="sn" @if($general->sn) checked @endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg--success">@lang('Cron Job Setting')</div>
                <div class="card-body">
                    <h6 class="my-2">@lang('Please Run The Cron Job On Your Server')</h6>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" id="ref" class="form-control"  value="{{route('cron')}}" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly>
                                    <a href="#" data-copytarget="#ref" class="input-group-text btn--success" id="basic-addon2">Cron Url</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="dashboard-w1 
                            @if(Carbon\Carbon::parse($general->last_cron_run)->diffInSeconds() < 10)
                                bg--green
                            @elseif(Carbon\Carbon::parse($general->last_cron_run)->diffInSeconds() < 20)
                                bg--warning
                            @else
                                bg--danger
                            @endif

                             b-radius--10 box-shadow has--link">
                                <div class="icon">
                                    <i class="la la-exchange-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="numbers">
                                        <span class="amount">{{diffforhumans($general->last_cron_run)}}</span>
                                    </div>
                                    <div class="desciption">
                                        <span>@lang('Last Cron Run')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush


@push('style')
    <style>
        .sp-replacer {
            padding: 0;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px 0 0 5px;
            border-right: none;
        }

        .sp-preview {
            width: 100px;
            height: 46px;
            border: 0;
        }

        .sp-preview-inner {
            width: 110px;
        }

        .sp-dd {
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function () {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function (color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function () {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });
        });


    </script>


<script>
    (function() {
        'use strict';
        // click events
        document.body.addEventListener('click', copy, true);
        // event handler
        function copy(e) {
            // find target element
            var
                t = e.target,
                c = t.dataset.copytarget,
                inp = (c ? document.querySelector(c) : null);

            // is element selectable?
            if (inp && inp.select) {
                // select text
                inp.select();
                try {
                    // copy text
                    document.execCommand('copy');
                    inp.blur();

                    iziToast.success({
                        message: "Cron Url Copied ",
                        position: "topRight"
                    });
                }
                catch (err) {
                    alert('please press Ctrl/Cmd+C to copy');
                }
            }
        }
    })();
</script>
@endpush

