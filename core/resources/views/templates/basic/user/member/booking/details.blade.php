@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
               <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             @lang('Service')
                            <span>{{__($booking_details->service->name) }}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Budget')
                            <span>{{getAmount($booking_details->budget) }} {{ $general->cur_text }}</span>
                          </li>

                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Booking Number')
                            <span>{{$booking_details->order_number}}</span>
                          </li>
                      
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              @lang('Status')
                                @if($booking_details->status == 1)
                                    <span class="badge text-white badge--completed">@lang('Running')</span>
                                @elseif($booking_details->status == 2)
                                    <span class="badge text-white badge--inprogress">@lang('Payable Journalist')</span>
                                @elseif($booking_details->status == 3)
                                    <span class="badge text-white badge--deliverd">@lang('Payable Member')</span>
                                @elseif($booking_details->status == 4)
                                    <span class="badge text-white badge--dispute">@lang('Payable Both')</span>
                                @elseif($booking_details->status == 5)
                                    <span class="badge text-white badge--inprogress">@lang('Paid')</span>
                                @elseif($booking_details->status == 6)
                                    <span class="badge text-white badge--inprogress">@lang('Refund')</span>
                                @endif
                          </li>

                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              @lang('Working Status')
                                    @if($booking_details->working_status == 0)
                                      <span class="badge text-white badge--pending">@lang('Pending')</span>
                                  @elseif($booking_details->working_status == 1)
                                     <span class="badge text-white badge--completed">@lang('Completed')</span>
                                  @elseif($booking_details->working_status == 2)
                                     <span class="badge text-white badge--deliverd">@lang('Delivered')</span>
                                  @elseif($booking_details->working_status == 3)
                                       <span class="badge text-white badge--inprogress">@lang('In Progress')</span>
                                  @elseif($booking_details->working_status == 4)
                                     <span class="badge text-white badge--cancel">@lang('Cancel')</span>
                                  @elseif($booking_details->working_status == 5)
                                       <span class="badge text-white badge--dispute">@lang('Dispute')</span>
                                  @elseif($booking_details->working_status ==  6)
                                       <span class="badge text-white badge--deliverdlate">@lang('Delivery Expired')</span>
                                  @endif
                          </li>
                          
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Created Date')
                            <span>{{ showDateTime($booking_details->created_at, 'd M Y')}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Delivery Time')
                            <span>{{ showDateTime($booking_details->delivery_date, 'd M Y')}}</span>
                          </li>
                        </ul>
                        <div class="card-title my-4"><h6>@lang('Description')</h6></div>
                        <div class="card-text">@php echo $booking_details->description @endphp</div>
                    </div>
                </div><!-- card end -->
            </div>
        </div><!-- row end -->
    </div>
</section>
@endsection
@push('script')
  <script>
     'use strict';
     (function($){
        $(".addVideoBtn").on('click', function(){
             var modal = $('#addModal');
             modal.modal('show');
        });
      })(jQuery)
  </script>
@endpush
