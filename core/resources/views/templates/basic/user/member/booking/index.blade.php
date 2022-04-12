@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive--lg p-0">
                        <table class="table style--two white-space-nowrap">
                            <thead>
                                <tr>
                                    <th>@lang('Booking Number')</th>
                                    <th>@lang('Journalist')</th>
                                    <th>@lang('Budget')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Working Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                           </thead>
                           <tbody>
                             @forelse ($bookings as  $book)
                                <tr>
                                    <td data-label="@lang('Booking Number')">{{ $book->order_number }}</td>
                                    <td data-label="@lang('Journalist')"><a href="{{ route('profile', $book->journalist->username) }}">{{ $book->journalist->username }}</a></td>
                                    <td data-label="@lang('Budget')">{{getAmount($book->budget)}} {{ $general->cur_text }}</td>
                                    <td data-label="@lang('Status')">
                                        @if($book->status == 1)
                                            <span class="badge text-white badge--completed">@lang('Running')</span>
                                        @elseif($book->status == 2)
                                            <span class="badge text-white badge--inprogress">@lang('Payable Journalist')</span>
                                        @elseif($book->status == 3)
                                            <span class="badge text-white badge--deliverd">@lang('Payable Member')</span>
                                        @elseif($book->status == 4)
                                            <span class="badge text-white badge--dispute">@lang('Payable Both')</span>
                                        @elseif($book->status == 5)
                                            <span class="badge text-white badge--paid">@lang('Paid')</span>
                                        @elseif($book->status == 6)
                                            <span class="badge text-white badge--paid">@lang('Refund')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Working Status')">
                                      @if($book->working_status == 0)
                                          <span class="badge text-white badge--pending">@lang('Pending')</span>
                                      @elseif($book->working_status == 1)
                                         <span class="badge text-white badge--completed">@lang('Completed')</span>
                                      @elseif($book->working_status == 2)
                                         <span class="badge text-white badge--deliverd">@lang('Delivered')</span>
                                      @elseif($book->working_status == 3)
                                           <span class="badge text-white badge--inprogress">@lang('In Progress')</span>
                                      @elseif($book->working_status == 4)
                                         <span class="badge text-white badge--cancel">@lang('Cancel')</span>
                                      @elseif($book->working_status == 5)
                                           <span class="badge text-white badge--dispute">@lang('Dispute')</span>
                                            <button class="icon-btn bg--1 text-white disputeReport" data-dispute_report ="{{ $book->dispute_report}}"  data-toggle="tooltip" title="" data-original-title="Report">
                                            <i class="las la-info-circle"></i>
                                          </button>
                                      @elseif($book->working_status ==  6)
                                           <span class="badge text-white badge--deliverdlate">@lang('Delivery Expired')</span>
                                      @endif
                                 </td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('user.member.booking.detail', $book->order_number) }}" class="icon-btn bg--2"><i class="las la-desktop text-white"></i></a>
                                    @if($book->working_status == 1)
                                        <a href="{{ route('user.member.work.download', $book->id) }}" class="icon-btn badge--paid"><i class="las la-cloud-download-alt text-white"></i></a>
                                    @elseif($book->working_status == 2)
                                        <a href="#" class="icon-btn bg--1 disputeWork" data-order_number="{{ $book->order_number }}"><i class="las la-times text-white"></i></a>
                                        <a href="#" class="icon-btn bg--5 completeBtn" data-order_number="{{ $book->order_number }}"><i class="las la-check text-white"></i></a>
                                        <a href="{{ route('user.member.work.download', $book->id) }}" class="icon-btn badge--paid"><i class="las la-cloud-download-alt text-white"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                   <td  class="text-muted text-center" colspan="100%">{{__($empty_message)}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
               </div>
            </div>
              {{ $bookings->links() }}
        </div>
    </div><!-- card end -->
</div>
</div><!-- row end -->
</div>
</section>

<!-- Modal -->
<div class="modal fade" id="approvedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="{{ route('user.member.work.delivery.approved') }}" method="POST">
        @csrf
        @method('POST')
        <div class="modal-body">
           <input type="hidden" name="order_number">
            <p>@lang('Are you sure want to approved this work delivery?')</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg--1 text-white btn-sm" data-dismiss="modal">@lang('Close')</button>
          <button type="submit" class="btn bg--5 text-white btn-sm">@lang('Approved')</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="disputeWorkDelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="" lass="modal-title" id="exampleModalLabel">@lang('Dispute This Work') </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        
            <div class="modal-body">
              <form action="{{ route('user.member.work.dispute') }}" method="POST">
                  @csrf
                  @method('GET')
                  <input type="hidden" name="order_number">
                  <div class="form-group">
                      <label for="report" class="font-width-bold">@lang('Why dispute this work ?')</label>
                      <textarea name="report" id="report" class="form-control" minlength="100" maxlength="500" placeholder="Minimum 100 word" required></textarea>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn bg--1 text-white btn-sm" data-dismiss="modal">@lang('Close')</button>
                      <button type="submit" class="btn bg--5 text-white btn-sm">@lang('Confirm')</button>
                  </div>
              </form>
            </div>
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
@endsection

@push('script')
  <script>
    'use strict';
    (function($){
      $('.completeBtn').on('click', function () {
           var modal = $('#approvedModal');
           modal.find('input[name=order_number]').val($(this).data('order_number'))
           modal.modal('show');
       });
       $('.disputeWork').on('click', function () {
            var modal = $('#disputeWorkDelivery');
            modal.find('input[name=order_number]').val($(this).data('order_number'))
            modal.modal('show');
        });
       $('.disputeReport').on('click', function () {
            var modal = $('#dispute_re');
            modal.find('#dispute').text($(this).data('dispute_report'))
            modal.modal('show');

        })
     })(jQuery)
  </script>
@endpush
