@extends('admin.layouts.app')
@section('panel')

    <?php
    $services=\App\Service::all();
$members=\App\User::all();
    ?>
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

                                    @if($booking->user_id)
                                  <a href="{{ route('admin.users.detail', $booking->user_id) }}">{{ $booking->journalist->username }}</a>

                                        @endif
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
                                  @elseif($booking->status == 7)
                                      <span class="font-weight-normal badge--warning">@lang('Pending Approval')</span>
                                    @endif
                               </td>

                                <td data-label="@lang('Action')">
                                    @if($booking->user_id)
                                    <a href="{{route('admin.booking.detail', $booking->id)}}" class="icon-btn btn--primary" data-toggle="tooltip" title="" data-original-title="Details">
                                      <i class="las la-desktop text--shadow"></i>
                                    </a>

                                  <!--    @if($booking->status == 7)
                                            <form action="{{route('admin.users.booking.approve')}}" method="POST">

                                                @csrf
                                                <input type="hidden" value="{{$booking->id}}" name="booking_id">
                                                <button type="submit" class="icon-btn btn-success">
                                                    Approve
                                                </button>
                                            </form>
                                          @endif
-->
                                        @endif
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

    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
<br />
    <br />


    <form action="{{route('admin.booking.search', $scope ?? str_replace('admin.booking.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="Member / Journalist / Booking Number ..." value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add A Booking')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.booking.store')}}" method="POST">
                @csrf
                <div class="modal-body">


                    <div class="form-group">
                        <label for="title" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>

                        {{--                        <div class="input-group-prepend">--}}
                        {{--                            <div class="input-group-text">{{ __($general->cur_text) }}</div>--}}
                        {{--                        </div>--}}

                        <input type="text" class="form-control" id="title" maxlength="191" name="title" value="{{old('title')}}"required placeholder="@lang('Title')">
                    </div>


{{--                    <div class="form-group">--}}
{{--                        <label for="name" class="form-control-label font-weight-bold">@lang('Member') <span class="text-danger">*</span></label>--}}

{{--                        <select class="form-control" required name="member_id">--}}
{{--                            <option>--select--</option>--}}
{{--                            @foreach($members  as $member)--}}
{{--                                <option value="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Service') <span class="text-danger">*</span></label>

<select class="form-control" required name="service_id">
    <option>--select--</option>
    @foreach($services as $service)
        <option value="{{$service->id}}">{{$service->name}}</option>
    @endforeach
</select>
                    </div>

                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('What is the Budget') ({{ __($general->cur_text) }}) <span class="text-danger">*</span></label>

{{--                        <div class="input-group-prepend">--}}
{{--                            <div class="input-group-text">{{ __($general->cur_text) }}</div>--}}
{{--                        </div>--}}

                        <input type="number" step=".1" min="1" class="form-control" id="name" maxlength="191" name="budget" value="{{old('budget')}}"required placeholder="@lang('Budget')">
                    </div>

                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Delivery Date') <span class="text-danger">*</span></label>
                        <input type="date" name="delivery_date" id="delivery_date" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ date('Y-m-d') }}" placeholder="@lang('Select Date')" autocomplete="off" required="">


                    </div>

                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Description') <span class="text-danger">*</span></label>

                  <textarea name="description" required class="form-control"></textarea>

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






@push('script')
<script>
    'use strict';
    $('.dispute_report').on('click', function () {
        var modal = $('#dispute_re');
        modal.find('#dispute').text($(this).data('dispute_report'))
        modal.modal('show');
    })

    $('.addBtn').on('click', function () {
        var modal = $('#addModal');
        modal.modal('show');
    });

    $('.updateBtn').on('click', function () {
        var modal = $('#updateBtn');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=name]').val($(this).data('name'));
        modal.modal('show');
    });
</script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/datepicker.min.css') }}">
@endpush
@push('script-lib')
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        'use strict';
        (function($){
            $('.datepicker-here').datepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                minDate: new Date(),
                autoClose: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
        })(jQuery)
    </script>
@endpush
