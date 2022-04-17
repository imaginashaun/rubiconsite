@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
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
                                    <td data-label="@lang('Date')">{{ diffforhumans($value->created_at) }}</td>
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
                {{$transaction->links()}}
            </div>
        </div>
    </div>
</section>
@endsection
