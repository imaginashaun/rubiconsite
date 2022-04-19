@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Admin Information')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Member Name')
                            <span class="font-weight-bold">{{$booking->member->username}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @switch($booking->member->status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Active')</span>
                                @break
                                @case(2)
                                <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                                @break
                            @endswitch
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Online Status')
                            @if($booking->member->isOnline())
                              <span class="badge badge-pill bg--success">@lang('Online')</span>
                            @else
                              <span class="badge badge-pill bg--warning">@lang('Offline')</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            @if($booking->user_id)
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">

                <a href="#" data-id="{{$booking->id}}" data-userid="{{$booking->journalist->id}}" class="completeWork btn btn-warning">Complete Work</a>

                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Journalist Information')</h5>
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{$booking->journalist->username}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Account Approval Status')
                            @switch($booking->journalist->account_status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Approved')</span>
                                @break
                                @case(0)
                                <span class="badge badge-pill bg--danger">@lang('Cancel')</span>
                                @break
                            @endswitch
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @switch($booking->journalist->status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Active')</span>
                                @break
                                @case(2)
                                <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                                @break
                            @endswitch
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Online Status')
                            @if($booking->journalist->isOnline())
                              <span class="badge badge-pill bg--success">@lang('Online')</span>
                            @else
                              <span class="badge badge-pill bg--warning">@lang('Offline')</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            @endif


        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="card">



                <div class="card-body">

                    <div class="card-title">
                        <h4>{{$booking->title}}</h4>

                    </div>

                     <ul class="list-group">
                         <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                            @lang('Service')
                           <span>{{$booking->service->name}}</span>
                         </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                           @lang('Budget')
                           <span>{{getAmount($booking->budget)}} {{$general->cur_text}}</span>
                         </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                           @lang('Booking Number')
                             <span>{{$booking->order_number}}</span>
                         </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                           @lang('Working Status')
                             @if($booking->working_status == 0)
                                 <span class="font-weight-normal badge--primary">@lang('Pending')</span>
                             @elseif($booking->working_status == 1)
                               <span class="font-weight-normal badge--success">@lang('Completed')</span>
                             @elseif($booking->working_status == 2)
                               <span class="font-weight-normal badge--success">@lang('Delivered')</span>
                             @elseif($booking->working_status == 3)
                               <span class="font-weight-normal badge--primary">@lang('In Progress')</span>
                             @elseif($booking->working_status == 4)
                                <span class="font-weight-normal badge--danger">@lang('Cancel')</span>
                             @elseif($booking->working_status == 5)
                                <span class="font-weight-normal badge--warning ml-auto mr-1">@lang('Dispute')</span>
                                <button class="icon-btn btn--danger dispute_report" data-dispute_report ="{{ $booking->dispute_report}}" data-toggle="tooltip" title="" data-original-title="Report">@lang('Report')</button>
                             @elseif($booking->working_status ==  6)
                                 <span class="font-weight-normal badge--warning">@lang('Delivery Expired')</span>

                             @endif
                         </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                           @lang('Status')
                                @if($booking->status == 1)
                                    <span class="font-weight-normal badge--success">@lang('Running')</span>
                                @elseif($booking->status == 2)
                                  <span class="font-weight-normal badge--warning">@lang('Payable Journalist')</span>
                                @elseif($booking->status == 3)
                                  <span class="font-weight-normal badge--warning">@lang('Payable Member')</span>
                                @elseif($booking->status == 4)
                                  <span class="font-weight-normal badge--warning">@lang('Payable Both')</span>
                                @elseif($booking->status == 5)
                                    <span class="font-weight-normal badge--success">@lang('Paid')</span>
                                @elseif($booking->status == 6)
                                    <span class="font-weight-normal badge--success">@lang('Refund')</span>
                                @endif
                         </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                           @lang('Delivery Date')
                             <span>{{showDateTime($booking->delivery_date, 'd M Y')}}</span>
                         </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                           @lang('Created Date')
                             <span>{{showDateTime($booking->created_at, 'd M Y')}}</span>
                         </li>
                     </ul>
                     <div class="card-title mt-3">@lang('Description')</div>
                     <div class="card-text">{{ $booking->description }}</div>
                    @if($booking->lastworkDelivery()!=null) <div class="card-title mt-3">@lang('Last Delivery Status')</div>
                    <div class="card-text">{{ $booking->lastworkDelivery()->approval_status }}</div>

                @endif

                    <hr>
                     <div class="card-title mt-3">
                         <h6>@lang('Work Delivery')</h6>
                     </div>
                      @forelse($booking->workDelivery as $value)
                        <div class="col-md-12">
                            <p class="mb-2">@lang('Delivery Details')</p>
                            <p>{{$value->details}}</p>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('admin.delivery.workFile.download', $value->id) }}" class="btn btn--success btn-sm">@lang('Download File')</a>
                        </div>
                      @empty
                        <div class="card-title mt-3">
                            @lang('Work File No Delivery')
                        </div>
                      @endforelse
                    @if($booking->user_id)
                        <div class="col-md-12 text-center">
                        <button  class="btn btn--success btn-sm m-2 text-center commentBtn">@lang('Add Comment')</button>
                    </div>

                    <h4>Comments</h4>
                        <div class="table-responsive--md  table-responsive">
                            <table class="table table--light style--two">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('ID')</th>
                                    <th scope="col">@lang('Comment')</th>
                                    <th scope="col">@lang('Sender')</th>
                                    <th scope="col">@lang('Date')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($booking->comments as $comment)
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
                            </table><!-- table end -->
                        </div>


@endif

                </div>
                </div>




            @if(!$booking->user_id)
            <div class="card mt-2">

                <div class="card-body">

                    <div class="card-title">
                        <h4>@lang('Expression of Interest')</h4>

                    </div>


                    <table class="table table--light style--two">
                        <thead>
                        <tr>

                            <th scope="col">@lang('Journalist')</th>
                            <th scope="col"></th>
                            <th scope="col">@lang('Date')</th>

                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>

                        @foreach($expressions as $expression)
                            <tr>
                                <td data-label="@lang('Journalist')">

                                    <a href="{{ route('admin.users.account', $expression->journalist_id)}}">
                                    {{$expression->username}}
                                    </a>
                                </td>

                                <td data-label="@lang('')">{{$expression->text}}</td>

                                <td data-label="@lang('Date')">{{showDateTime($expression->created_at, 'd M Y')}}</td>

                                <td data-label="@lang('Action')"><a href="#" data-id="{{$booking->id}}" data-userid="{{$expression->journalist_id}}" class="awardjournalist btn btn-success">Award</a></td>
                            </tr>
                            @endforeach

                    </table>

                </div>

            </div>
            @endif

              </div>
          </div>


    <div class="modal fade" id="rejectwork" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Reject Work')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.users.booking.rejectwork')}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure you want to reject the last work submitted?')</p>
                       <h2>Select Reason</h2>
                        <select class="form-control mt-4" name="approval_status" required>
                            <option value="">--Select--</option>
                            <option value="Has been rejected">I do not like the work</option>
                            <option value="Similar work has already been submitted">Similar work has already been submitted</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="modal fade" id="sellerPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Accept Work')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{route('admin.send.money.journalist')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you happy with the work done?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <div class="modal fade" id="awardJournalist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Award this Journalist')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.send.money.awardthejournalist')}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="user_id">
                    <div class="modal-body">
                        <p>@lang('Are you sure you would like to award the work to this journalist?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--success">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="completeWork" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Work Completed')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.send.money.awardthejournalist')}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="user_id">
                    <div class="modal-body">
                        <p>@lang('Was the work completed to your satisfaction and you would like to close the project?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--success">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="buyerPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Refund Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{route('admin.refund.money.member')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure you want to refund this member?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="dispute_re" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Dispute Report')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <p id="dispute"></p>
            </div>
        </div>
    </div>
</div>

    <div id="comment" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add A Comment')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.users.booking.comment')}}" method="POST">
                    @csrf
                    <div class="modal-body">

<input type="hidden" value="{{$booking->id}}" name="booking_id">


                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Comment') <span class="text-danger">*</span></label>

                            <textarea name="comment" required class="form-control">


                  </textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    @if(count($booking->workDelivery)>0 && $booking->status != 5 && $booking->lastworkDelivery()!=null)
       @if($booking->lastworkDelivery()->approval_status!='Has been approved') <button class="icon-btn btn--warning ml-2 rejectwork" data-toggle="tooltip" title="" data-id="{{$booking->id}}" data-original-title="Disapprove Work"><i class="las la-credit-card"></i>
            @lang('Reject Work')
        </button>

       @endif
       @if($booking->lastworkDelivery()->approval_status!='Has been approved') <button class="icon-btn btn--success ml-2 journalist" data-toggle="tooltip" title="" data-id="{{$booking->id}}" data-original-title="Journalist Payment"><i class="las la-credit-card"></i>
            @lang('Accept Work')
        </button>

           @endif

    @endif
@endpush

@push('script')
<script>
    (function () {
         "use strict";

         $('.journalist').on('click', function () {
            var modal = $('#sellerPayment');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

         $('.awardjournalist').on('click', function () {
            var modal = $('#awardJournalist');
            modal.find('input[name=booking_id]').val($(this).data('id'))
            modal.find('input[name=user_id]').val($(this).data('userid'))
            modal.modal('show');
        });



        $('.completeWork').on('click', function () {
            var modal = $('#completeWork');
            modal.find('input[name=booking_id]').val($(this).data('id'))
            modal.find('input[name=user_id]').val($(this).data('userid'))
            modal.modal('show');
        });


        $('.rejectwork').on('click', function () {
            var modal = $('#rejectwork');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        $('.member').on('click', function () {
            var modal = $('#buyerPayment');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });


        $('.commentBtn').on('click', function () {
            var modal = $('#comment');
            modal.modal('show');
        });

        $('.dispute_report').on('click', function () {
            var modal = $('#dispute_re');
            modal.find('#dispute').text($(this).data('dispute_report'))
            modal.modal('show');
        })
    })();
</script>
@endpush
