@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row mb-none-30">
                <!--    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="d-widget-two color--four d-flex flex-wrap align-items-center">
                            <div class="col-8">
                                <span class="caption">@lang('Current Balance')</span>
                                <h4 class="currency-amount">{{getAmount(auth()->user()->balance) }} {{ $general->cur_text }}</h4>
                                <a href="{{route('user.transaction.log')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4 text-right">
                                <div class="icon">
                                    <i class="las la-wallet"></i>
                                </div>Pending Projects
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="d-widget-two color--five d-flex flex-wrap align-items-center">
                            <div class="col-8">
                                <span class="caption">@lang('Total Withdraw Amount')</span>
                                <h4 class="currency-amount">{{getAmount($withdraw)}} {{$general->cur_text}}</h4>
                                <a href="{{route('user.withdraw.history')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4 text-right">
                                <div class="icon">
                                    <i class="las la-history"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="d-widget-two color--six d-flex flex-wrap align-items-center">
                            <div class="col-8">
                                <span class="caption">@lang('Total Transaction')</span>
                                <h4 class="currency-amount">{{__($transaction_count) }}</h4>
                                <a href="{{route('user.transaction.log')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4 text-right">
                                <div class="icon">
                                    <i class="las la-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->


                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap align-items-center">
                            <div class="col-8">
                                <span class="caption">@lang('Available Work')</span>
                                <h4 class="currency-amount">{{$booking['pending']}}</h4>
                                <a href="{{ route('user.journalist.booking.pending') }}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4 text-right">
                                <div class="icon">
                                    <i class="las la-pause-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="d-widget-two color--three d-flex flex-wrap align-items-center">
                            <div class="col-8">
                                <span class="caption">@lang('Work Inprogress')</span>
                                <h4 class="currency-amount">{{$booking['inprogress']}}</h4>
                                <a href="{{ route('user.journalist.booking.inprogress') }}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4 text-right">
                                <div class="icon">
                                    <i class="las la-spinner"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="d-widget-two color--two d-flex flex-wrap align-items-center">
                            <div class="col-8">
                                <span class="caption">@lang('Completed Work')</span>
                                <h4 class="currency-amount">{{$booking['complete']}}</h4>
                                <a href="{{ route('user.journalist.booking.complete') }}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4 text-right">
                                <div class="icon">
                                    <i class="las la-list-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

<!--                <div class="row mt-50">
                    <div class="col-lg-12">
                        <h5 class="py-3">@lang('Transaction Log')</h5>
                        <div class="card">
                            <div class="card-body table-responsive--lg p-0">
                                <table class="table style--two white-space-nowrap">
                                    <thead>
                                        <tr>
                                            <th>@lang('Id')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang('Charge')</th>
                                            <th>@lang('Post Balance')</th>
                                            <th>@lang('Trx')</th>
                                            <th>@lang('Details')</th>
                                            <th>@lang('Created Date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($transaction as $key => $value)
                                        <tr>
                                            <td data-label="@lang('Id')">{{ ++$key }}</td>
                                            <td data-label="@lang('Amount')">
                                              <strong @if($value->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($value->trx_type == '+') ? '+':'-'}} {{getAmount($value->amount)}} {{$general->cur_text}}</strong>
                                            </td>
                                            <td data-label="@lang('Charge')">{{ getAmount($value->charge) }}</td>
                                            <td data-label="@lang('Post Balance')">{{ getAmount($value->post_balance) }} {{$general->cur_text}}</td>
                                            <td data-label="@lang('Trx')">{{ $value->trx }}</td>
                                            <td data-label="@lang('Details')">{{ $value->details }}</td>
                                            <td data-label="@lang('Created Date')">{{ diffforhumans($value->created_at) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                          <td class="text-muted text-center" colspan="100%">@lang('No Data')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        <div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>
</div>
</section>
@endsection
