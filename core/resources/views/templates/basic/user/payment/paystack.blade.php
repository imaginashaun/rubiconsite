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
                                    <form action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" class="text-center">
                                        @csrf

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Please Pay amount') <span>{{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('To get Amount')  <span>{{getAmount($deposit->amount)}}  {{$general->cur_text}}</span></li>
                                        </ul>
                                        <div class="card-body text-center">
                                            <button type="button" class=" mt-4 cmn-btn btn-round custom-success text-center btn-lg" id="btn-confirm">@lang('Pay Now')</button>
                                        </div>
                                        <script
                                            src="//js.paystack.co/v1/inline.js"
                                            data-key="{{ $data->key }}"
                                            data-email="{{ $data->email }}"
                                            data-amount="{{$data->amount}}"
                                            data-currency="{{$data->currency}}"
                                            data-ref="{{ $data->ref }}"
                                            data-custom-button="btn-confirm"
                                        >
                                        </script>
                                    </form>
                                </div>
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

@endpush
