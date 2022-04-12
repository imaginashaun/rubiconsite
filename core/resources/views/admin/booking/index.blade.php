@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('ID')</th>
                                <th scope="col">@lang('Member Name')</th>
                                <th scope="col">@lang('Journalist Username')</th>
                                <th scope="col">@lang('Booking Number')</th>
                                <th scope="col">@lang('Budget')</th>
                                <th scope="col">@lang('Delivery Date')</th>
                                <th scope="col">@lang('Working Status')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                <td data-label="@lang('Id')">{{$loop->iteration}}</td>
                                <td data-label="@lang('Member Name')">
                                  <a href="{{ route('admin.member.users.detail', $booking->member_id) }}">{{ $booking->member->username }}</a>
                                </td>
                                <td data-label="@lang('Journalist')">
                                  <a href="{{ route('admin.users.detail', $booking->user_id) }}">{{ $booking->journalist->username }}</a>
                                </td>
                                <td data-label="@lang('Booking Number')">{{$booking->order_number}}</td>
                                <td data-label="@lang('Budget')">{{getAmount($booking->budget)}} {{$general->cur_text }}</td>
                                <td data-label="@lang('Delivery Date')">{{showDateTime($booking->delivery_date, 'd M Y')}}</td>
                                <td data-label="@lang('Working Status')">
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
                                          <span class="font-weight-normal badge--warning">@lang('Dispute')</span>
                                          <button class="icon-btn btn--danger dispute_report" data-dispute_report ="{{ $booking->dispute_report}}"  data-toggle="tooltip" title="" data-original-title="Report">
                                            @lang('Report')
                                          </button>
                                    @elseif($booking->working_status == 6)
                                        <span class="font-weight-normal badge--danger">@lang('Delivery Expired')</span>
                                    @endif
                              </td>
                              <td data-label="@lang('Status')">
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
                               </td>

                                <td data-label="@lang('Action')">
                                    <a href="{{route('admin.booking.detail', $booking->id)}}" class="icon-btn btn--primary" data-toggle="tooltip" title="" data-original-title="Details">
                                      <i class="las la-desktop text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $bookings->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
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

@push('breadcrumb-plugins')
    <form action="{{route('admin.booking.search', $scope ?? str_replace('admin.booking.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="Member / Journalist / Booking Number ..." value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

@push('script')
<script>
    'use strict';
    $('.dispute_report').on('click', function () {
        var modal = $('#dispute_re');
        modal.find('#dispute').text($(this).data('dispute_report'))
        modal.modal('show');
    })
</script>
@endpush
