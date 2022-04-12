@extends('admin.layouts.app')
@section('panel')

    <div class="row justify-content-center">
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--success">
            <div class="widget-two__content">
                <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',1)->sum('amount') }}</h2>
                <p class="text-white">@lang('Approved Withdrawals')</p>
            </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--6">
                <div class="widget-two__content">
                    <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',2)->sum('amount') }}</h2>
                    <p class="text-white">@lang('Pending Withdrawals')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--pink">
            <div class="widget-two__content">
                <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',3)->sum('amount') }}</h2>
                <p class="text-white">@lang('Rejected Withdrawals')</p>
            </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Trx Number')</th>
                                <th scope="col">@lang('Method')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Charge')</th>
                                <th scope="col">@lang('After Charge')</th>
                                <th scope="col">@lang('Rate')</th>
                                <th scope="col">@lang('Payable')</th>
                                <th scope="col">@lang('Status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($withdrawals as $withdraw)
                                @php
                                    $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                                @endphp
                                <tr>
                                    <td data-label="@lang('Date')">{{ showDateTime($withdraw->created_at) }}</td>
                                    <td data-label="@lang('Trx Number')" class="font-weight-bold">{{ strtoupper($withdraw->trx) }}</td>
                                  
                                    <td data-label="@lang('Method')"> 
                                       <a href="{{ route('admin.member.users.withdrawals.method',[$withdraw->method->id,@$type?$type:'all',$userId]) }}"> {{ __(@$withdraw->method->name) }}</a>
                                    </td>
                                    <td data-label="@lang('Amount')" class="budget font-weight-bold">{{ getAmount($withdraw->amount) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Charge')" class="budget text-danger">{{ getAmount($withdraw->charge) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('After Charge')" class="budget">{{ getAmount($withdraw->after_charge) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Rate')" class="budget">{{ getAmount($withdraw->rate) }}  {{__($withdraw->currency)}}</td>

                                    <td data-label="@lang('Payable')" class="budget font-weight-bold">{{ getAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }} </td>
                                
                               
                                    <td data-label="@lang('Status')">
                                        @if($withdraw->status == 2)
                                            <span class="text--small badge font-weight-normal badge--warning">@lang('Pending')</span>
                                        @elseif($withdraw->status == 1)
                                            <span class="text--small badge font-weight-normal badge--success">@lang('Approved')</span>
                                        @elseif($withdraw->status == 3)
                                            <span class="text--small badge font-weight-normal badge--danger">@lang('Rejected')</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                <div class="card-footer py-4">
                    {{ $withdrawals->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection

