@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{$deposit->gateway_currency()->methodImage()}}" class="card-img-top w-100" alt="@lang('Image')">
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('Final Step')</h5>
                                </div> 

                                <form action="{{$data->url}}" method="{{$data->method}}">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount') <span>{{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount')  <span>{{getAmount($deposit->amount)}}  {{$general->cur_text}}</span></li>
                                    </ul>
                                    <script src="{{$data->checkout_js}}"
                                            @foreach($data->val as $key=>$value)
                                            data-{{$key}}="{{$value}}"
                                        @endforeach >
                                    </script>
                                    <div class="card-body text-center">
                                        <input type="hidden" custom="{{$data->custom}}" name="hidden">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $('input[type="submit"]').addClass("ml-4 cmn-btn btn-custom2 text-center btn-lg");
        })
    </script>
@endpush
