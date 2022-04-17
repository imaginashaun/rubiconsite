@extends($activeTemplate.'layouts.journalist')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <div class="text-right my-2">
                        <a href="{{url('user/journalist/booking/create')}}" class="btn bg--6 text-white addVideoBtn"><i class="las la-plus"></i> @lang('Pitch a Story')</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive--lg p-0">
                            <table class="table style--two white-space-nowrap">
                                <thead>
                                <tr>
                                    <th>@lang('Order Number')</th>
                                    <th>@lang('Member')</th>
                                    <th>@lang('Budget')</th>
                                    <th>@lang('Delivery Date')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Working Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($booking as  $book)
                                    <tr>
                                        <td data-label="@lang('Order Number')">{{ __($book->order_number) }}</td>
                                        <td data-label="@lang('Member')">{{$book->member->username}}</td>
                                        <td data-label="@lang('Budget')">{{getAmount($book->budget) }} {{ $general->cur_text }}</td>
                                        <td data-label="@lang('Delivery Date')">{{showDateTime($book->delivery_date, 'd M Y')}}</td>
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
                                                <span class="badge text-white badge--inprogress">@lang('Refund')</span>

                                            @elseif($book->status == 7)
                                                <span class="badge text-white badge--pending">@lang('Pending Acceptance by Admin')</span>
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
                                            <a href="{{ route('user.journalist.booking.details', $book->order_number)}}" class="icon-btn bg--2"><i class="las la-desktop text-white"></i></a>
                                            @if($book->working_status == 0)
{{--                                                <a href="#" class="icon-btn bg--5 approvedBtn" data-order_number="{{ $book->order_number }}"><i class="las la-check text-white"></i></a>--}}
                                                <a href="#" class="icon-btn bg--1 cancelbtn" data-order_number="{{ $book->order_number }}"><i class="las la-times text-light"></i></a>
                                            @elseif($book->working_status == 2 || $book->working_status == 3)
                                                <a href="#" class="icon-btn bg-dark workFile" data-order_number="{{ $book->order_number }}"><i class="las la-truck-loading text-white"></i></a>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{$empty_message}}</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $booking->links() }}
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="approvedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.journalist.booking.approved.update') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="order_number">
                        <p>@lang('Are you sure want to accept this work?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn bg--5 text-white">@lang('Approved')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Cancel Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.journalist.booking.cancel.update') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="order_number">
                        <p>@lang('Are you sure want to cancel this work?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn bg--5 text-white">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="work_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Work Delivery')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.journalist.work.delivery') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="order_number">
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Upload Work') <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file" required>
                                <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                <small>@lang('Supported files:Must be zip')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea rows="5" class="form-control" name="details" placeholder="@lang('Describe Your Delivery Details')k ...." required></textarea>
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
            $('.approvedBtn').on('click', function () {
                var modal = $('#approvedModal');
                modal.find('input[name=order_number]').val($(this).data('order_number'))
                modal.modal('show');
            });

            $('.cancelbtn').on('click', function () {
                var modal = $('#cancelModal');
                modal.find('input[name=order_number]').val($(this).data('order_number'))
                modal.modal('show');
            });

            $('.workFile').on('click', function () {
                var modal = $('#work_file');
                modal.find('input[name=order_number]').val($(this).data('order_number'))
                modal.modal('show');
            });

            $('.disputeReport').on('click', function () {
                var modal = $('#dispute_re');
                modal.find('#dispute').text($(this).data('dispute_report'))
                modal.modal('show');

            })

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        })(jQuery)
    </script>
@endpush
