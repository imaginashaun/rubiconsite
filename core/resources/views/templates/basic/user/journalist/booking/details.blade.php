@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
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
                            <span>{{getAmount($booking_details->budget)}} {{$general->cur_text}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Order Number')
                            <span>{{__($booking_details->order_number) }}</span>
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
                                <span class="badge text-white badge--paid">@lang('Paid')</span>
                            @elseif($booking_details->status == 6)
                                <span class="badge text-white badge--inprogress">@lang('Refund')</span>
                            @endif
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Created Date')
                            <span>{{showDateTime($booking_details->created_at, 'd M Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Delivery Date')
                            <span>{{showDateTime($booking_details->delivery_date, 'd M Y')}}</span>
                        </li>
                    </ul>
                     <div class="card-title my-4"><h6>@lang('Description')</h6></div>
                     <div class="card-text">@php echo $booking_details->description @endphp</div>

{{--                     <div class="text-right my-2">--}}

{{--                         <button href="#" class="icon-btn bg-dark comment1" data-order_number="{{ $booking_details->order_number }}">Add Comment</button>--}}

{{--                     </div>--}}
@if($booking_details->lastworkDelivery()!=null)
                     <div class="text-right my-2">
                         <a href="#" class="btn bg--6 text-white comment"><i class="las la-plus"></i> @lang('Add a comment')</a>
                     </div>

                     @endif
                    @if(count($booking_details->comments)>0)
                        <hr>


                         <h4>Comments</h4>


                         <div class="card-body table-responsive--lg p-0">
                         <table class="table style--two white-space-nowrap">
                             <thead>
                             <tr>
                                 <th scope="col">@lang('ID')</th>
                                 <th scope="col">@lang('Comment')</th>
                                 <th scope="col">@lang('Sender')</th>
                                 <th scope="col">@lang('Date')</th>
                             </tr>
                             </thead>
                             <tbody>
                             @forelse ($booking_details->comments as  $comment)
                                 <tr>
                                     <td>{{$comment->id}}</td>



                                     <td>{{$comment->comment}}</td><td>{{$comment->sender}}</td><td>{{$comment->created_at}}</td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td class="text-muted text-center" colspan="100%">No comments</td>
                                 </tr>
                             @endforelse

                             </tbody>
                         </table>
                     </div>
                     @endif

                  </div>


                   <div class="card-footer">
                   <a href="#" class="btn btn-success expressInterestButton" data-order_number="{{ $booking_details->order_number }}">Express Interest</a>
                   </div>

               </div><!-- card end -->
             </div>
           </div>
         </div>
       </section>

<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Add comment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action=" {{ url('user/journalist/booking/comment') }} " method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
{{--                    <input type="hidden" name="order_number">--}}
                    <input type="hidden" name="order_number" value="{{$booking_details->order_number}}">

                    <div class="form-group">
                        <label class="font-weight-bold">@lang('Comment') <span class="text-danger">*</span></label>

                        <textarea rows="5" class="form-control" name="comment" placeholder="@lang('Type something') ...." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn bg--5 text-white">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
  <script>
     'use strict';
      (function($){

          $('.expressInterestButton').on('click', function () {
              var modal = $('#expressionOfInterest');
              modal.find('input[name=order_number]').val($(this).data('order_number'))
              modal.modal('show');
          });

        $(".addVideoBtn").on('click', function(){
             var modal = $('#addModal');
             modal.modal('show');
        });
      })(jQuery)

     $('.comment').on('click', function () {
         var modal = $('#comment');
         modal.modal('show');
     });
  </script>
@endpush
