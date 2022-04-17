@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
 <section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{$deposit->gateway_currency()->methodImage()}}" class="card-img-top" alt="@lang('Image')" class="w-100">
                        </div>
                        <div class="col-md-8 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('Final Step')</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount') <span>{{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</span></li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount')  <span>{{getAmount($deposit->amount)}}  {{$general->cur_text}}</span></li>
                                </ul>
                            <button type="button" class=" mt-4 cmn-btn btn-round custom-success text-center btn-lg" id="btn-confirm">@lang('Pay Now')</button>
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
    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        "use strict";
        closedFunction = function() {
        }
        successFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }
        failedFunction=function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}' ;
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo:"{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '5af93ca2913fd',
                store_id:"{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed:closedFunction,
                success:successFunction,
                failed:failedFunction
            });
        }

        $(document).ready(function () {
            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        });
    </script>
@endpush
