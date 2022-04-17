@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
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

                                     <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount') <span>{{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount')  <span>{{getAmount($deposit->amount)}}  {{$general->cur_text}}</span></li>
                                    </ul>

                                    <div class="card-body text-center">
                                        <button type="button" class="btn cmn-btn mt-4 btn-custom2 " id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
                                    </div>
                                </div>

                                <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                                <script>
                                    var btn = document.querySelector("#btn-confirm");
                                    btn.setAttribute("type", "button");
                                    const API_publicKey = "{{$data->API_publicKey}}";

                                    function payWithRave() {
                                        var x = getpaidSetup({
                                            PBFPubKey: API_publicKey,
                                            customer_email: "{{$data->customer_email}}",
                                            amount: "{{$data->amount }}",
                                            customer_phone: "{{$data->customer_phone}}",
                                            currency: "{{$data->currency}}",
                                            txref: "{{$data->txref}}",
                                            onclose: function () {
                                            },
                                            callback: function (response) {
                                                var txref = response.tx.txRef;
                                                var status = response.tx.status;
                                                var chargeResponse = response.tx.chargeResponseCode;
                                                if (chargeResponse == "00" || chargeResponse == "0") {
                                                    window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                                                } else {
                                                    window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                                                }
                                                    // x.close(); // use this to close the modal immediately after payment.
                                                }
                                            });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
