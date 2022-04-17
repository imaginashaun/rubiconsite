@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row mb-none-30">

                     <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">@lang('Current Balance')</span>
                                <h4 class="currency-amount">{{getAmount(auth()->user()->balance)}} {{$general->cur_text}}</h4>
                                <a href="{{route('user.member.transaction.log')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                   <i class="las la-euro-sign"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>

                     <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">@lang('Total Deposit Amount')</span>
                                <h4 class="currency-amount">{{getAmount($deposit)}} {{$general->cur_text}}</h4>
                                <a href="{{route('user.member.deposit.history')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-wallet"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>

                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">@lang('Total Withdraw Amount')</span>
                                <h4 class="currency-amount">{{getAmount($withdraw)}} {{$general->cur_text}}</h4>
                                <a href="{{route('user.member.withdraw.history')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-credit-card"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>


                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">@lang('Total Pending Booking')</span>
                                <h4 class="currency-amount">{{$booking['pending']}}</h4>
                                <a href="{{route('user.member.booking.pending.list')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-shopping-bag"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>

                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">@lang('Total Complete Booking')</span>
                                <h4 class="currency-amount">{{$booking['complete']}}</h4>
                                <a href="{{route('user.member.booking.complete.list')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-list-alt"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>

                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget-two d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">@lang('Total Transaction')</span>
                                <h4 class="currency-amount">{{$totalTransaction}}</h4>
                                <a href="{{route('user.member.transaction.log')}}" class="action-btn fs-12px mt-3">@lang('View All')</a>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-money-check"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>

                </div><!-- row end -->

                <div class="row mt-50">
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
                                      <th>@lang('Trx Details')</th>
                                      <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                              <tbody>
                                @forelse ($transaction as $key => $value)
                                <tr>
                                    <td data-label="@lang('Id')">{{ ++$key }}</td>
                                    <td data-label="@lang('Amount')">
                                      <strong @if($value->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($value->trx_type == '+') ? '+':'-'}} {{getAmount($value->amount)}} {{$general->cur_text}}</strong>
                                    </td>
                                    <td data-label="@lang('Charge')">{{ getAmount($value->charge) }} {{ $general->cur_text }}</td>
                                    <td data-label="@lang('Post Balance')">{{ getAmount($value->post_balance) }} {{ $general->cur_text }}</td>
                                    <td data-label="@lang('Trx')">{{ $value->trx }}</td>
                                    <td data-label="@lang('Trx Details')">{{ $value->details }}</td>
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
                </div>

            </div>
        </div><!-- row end -->
    </div>
</div>
</div>
</section>
@endsection
