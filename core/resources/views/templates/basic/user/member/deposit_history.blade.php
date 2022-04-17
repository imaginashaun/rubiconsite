@extends($activeTemplate.'layouts.member')
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
                                  <th scope="col">@lang('Transaction ID')</th>
                                  <th scope="col">@lang('Gateway')</th>
                                  <th scope="col">@lang('Amount')</th>
                                  <th scope="col">@lang('Status')</th>
                                  <th scope="col">@lang('Time')</th>
                                  <th scope="col"> @lang('MORE')</th>
                              </tr>
                              </thead>
                              <tbody>
                              @if(count($logs) >0)
                                  @foreach($logs as $k=>$data)
                                      <tr>
                                          <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                                          <td data-label="@lang('Gateway')">{{ $data->gateway->name   }}</td>
                                          <td data-label="@lang('Amount')">
                                              <strong>{{getAmount($data->amount)}} {{$general->cur_text}}</strong>
                                          </td>
                                          <td data-label="@lang('Status')">
                                              @if($data->status == 1)
                                                  <span class="badge text-white badge--completed">@lang('Complete')</span>
                                              @elseif($data->status == 2)
                                                  <span class="badge text-white badge--pending">@lang('Pending')</span>
                                              @elseif($data->status == 3)
                                                  <span class="badge text-white badge--cancel">@lang('Cancel')</span>
                                              @endif

                                              @if($data->admin_feedback != null)
                                                  <button class="btn-info btn-rounded  badge detailBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></button>
                                              @endif
                                          </td>
                                          <td data-label="@lang('Time')">
                                             {{\Carbon\Carbon::parse($data->created_at)->format('d M Y')}}
                                          </td>
                                          @php
                                              $details = ($data->detail != null) ? json_encode($data->detail) : null;
                                          @endphp
                                          <td data-label="@lang('Details')">
                                              <a href="javascript:void(0)" class="icon-btn bg--2 text-white approveBtn"
                                                 data-info="{{$details}}"
                                                 data-id="{{ $data->id }}"
                                                 data-amount="{{ getAmount($data->amount)}} {{ $general->cur_text }}"
                                                 data-charge="{{ getAmount($data->charge)}} {{ $general->cur_text }}"
                                                 data-after_charge="{{ getAmount($data->amount + $data->charge)}} {{ $general->cur_text }}"
                                                 data-rate="{{ getAmount($data->rate)}} {{ $data->method_currency }}"
                                                 data-payable="{{ getAmount($data->final_amo)}} {{ $data->method_currency }}">
                                                  <i class="fa fa-desktop"></i>
                                              </a>
                                          </td>
                                      </tr>
                                  @endforeach
                              @else
                                  <tr>
                                      <td class="text-muted text-center" colspan="100%"> @lang('No results found')!</td>
                                  </tr>
                              @endif
                              </tbody>
                          </table>
                        </div>
                    </div>
                    {{$logs->links()}}
                </div>
            </div>
        </div>
  </section>



    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group text-center">
                        <li class="list-group-item dark-bg">@lang('Amount') : <span class="withdraw-amount "></span></li>
                        <li class="list-group-item dark-bg">@lang('Charge') : <span class="withdraw-charge "></span></li>
                        <li class="list-group-item dark-bg">@lang('After Charge') : <span class="withdraw-after_charge"></span></li>
                        <li class="list-group-item dark-bg">@lang('Conversion Rate') : <span class="withdraw-rate"></span></li>
                        <li class="list-group-item dark-bg">@lang('Payable Amount') : <span class="withdraw-payable"></span></li>
                    </ul>
                    <ul class="list-group withdraw-detail mt-1">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-block bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="withdraw-detail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
      'use strict';
        $('.approveBtn').on('click', function() {
            var modal = $('#approveModal');
            modal.find('.withdraw-amount').text($(this).data('amount'));
            modal.find('.withdraw-charge').text($(this).data('charge'));
            modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
            modal.find('.withdraw-rate').text($(this).data('rate'));
            modal.find('.withdraw-payable').text($(this).data('payable'));
            var list = [];
            var details =  Object.entries($(this).data('info'));

            var ImgPath = "{{asset(imagePath()['verify']['deposit']['path'])}}/";
            var singleInfo = '';
            for (var i = 0; i < details.length; i++) {
                if (details[i][1].type == 'file') {
                    singleInfo += `<li class="list-group-item">
                                        <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="..." class="w-100">
                                    </li>`;
                }else{
                    singleInfo += `<li class="list-group-item">
                                        <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <span class="font-weight-bold ml-3">${details[i][1].field_name}</span>
                                    </li>`;
                }
            }

            if (singleInfo)
            {
                modal.find('.withdraw-detail').html(`<br><strong class="my-3">@lang('Payment Information')</strong>  ${singleInfo}`);
            }else{
                modal.find('.withdraw-detail').html(`${singleInfo}`);
            }
            modal.modal('show');
        });
    </script>

    <script>
      'use strict';
        $('.detailBtn').on('click', function() {
            var modal = $('#detailModal');
            var feedback = $(this).data('admin_feedback');
            modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
            modal.modal('show');
        });

    </script>
@endpush
