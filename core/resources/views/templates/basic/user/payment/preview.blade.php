@extends($activeTemplate.'layouts.member')
@section('content')
@push('style')
<style>
      .rounded-img {
        width: 100%;
        max-width: 550px;
        margin: 0 auto;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        overflow: hidden;
        margin-bottom: 15px
      }
      .rounded-img img {
        width: 100%;
      }
    </style>
@endpush

@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="rounded-img">
                          <img src="{{ $data->gateway_currency()->methodImage() }}" class="w-100" />
                        </div>
                    </div>
                    <div class="col-md-8">
                      <ul class="list-group text-center">
                        <p class="list-group-item">
                            @lang('Amount'):
                            <strong>{{getAmount($data->amount)}} </strong> {{$general->cur_text}}
                        </p>
                        <p class="list-group-item">
                            @lang('Charge'):
                            <strong>{{getAmount($data->charge)}}</strong> {{$general->cur_text}}
                        </p>

                        <p class="list-group-item">
                            @lang('Payable'): <strong> {{getAmount($data->amount + $data->charge)}}</strong> {{$general->cur_text}}
                        </p>

                        <p class="list-group-item">
                            @lang('Conversion Rate'): <strong>1 {{$general->cur_text}} = {{getAmount($data->rate)}}  {{$data->baseCurrency()}}</strong>
                        </p>

                        <p class="list-group-item">
                            @lang('In') {{$data->baseCurrency()}}:
                            <strong>{{getAmount($data->final_amo)}}</strong>
                        </p>
                      </ul>

                        @if($data->gateway->crypto==1)
                            <p class="list-group-item">
                                @lang('Conversion with')
                                <b> {{ $data->method_currency }}</b> @lang('and final value will Show on next step')
                            </p>
                        @endif
                        @if( 1000 >$data->method_code)
                            <a href="{{route('user.member.deposit.confirm')}}" class="cmn-btn btn btn-block font-weight-bold">@lang('Pay Now')</a>
                        @else
                            <a href="{{route('user.member.deposit.manual.confirm')}}" class="cmn-btn btn btn-block font-weight-bold">@lang('Pay Now')</a>
                        @endif
                  </div>
              </div>
        </div>
    </div>
</div>
</section>
@endsection
