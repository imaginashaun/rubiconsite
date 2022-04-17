@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="text-right my-2">
                   <button type="button" class="btn bg--6 text-white addemployment">@lang('Add New') <i class="las la-plus"></i></button>
                </div>
                  <div class="card">
                      <div class="card-body table-responsive--lg p-0">
                        <table class="table style--two white-space-nowrap">
                            <thead >
                                <tr>
                                    <th scope="col">@lang('Id')</th>
                                    <th scope="col">@lang('Company')</th>
                                    <th scope="col">@lang('City')</th>
                                    <th scope="col">@lang('Country')</th>
                                    <th scope="col">@lang('Designation')</th>
                                    <th scope="col">@lang('Start Date')</th>
                                    <th scope="col">@lang('End Date')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                                <tbody>
                                @forelse($employments as  $employment)
                                    <tr>
                                        <td data-label="@lang('Id')">{{$loop->iteration }}</td>
                                        <td data-label="@lang('Company')">{{$employment->company }}</td>
                                        <td data-label="@lang('City')">{{$employment->city }}</td>
                                        <td data-label="@lang('Country')">{{$employment->country }}</td>
                                        <td data-label="@lang('Designation')">{{$employment->designation }}</td>
                                        <td data-label="@lang('Start Date')">{{showDateTime($employment->start_date, 'd M Y') }}</td>
                                        <td data-label="@lang('End Date')">{{showDateTime($employment->end_date, 'd M Y') }}</td>
                                        <td data-label="@lang('Action')">
                                            <button type="button" data-id="{{ $employment->id }}" data-company="{{ $employment->company }}" data-designation="{{ $employment->designation }}"  data-city="{{ $employment->city }}" data-country="{{ $employment->country }}" data-start_date="{{ $employment->start_date }}"data-end_date="{{ $employment->end_date }}" class="icon-btn bg--2 text-white editbtnemployment"><i class="las la-edit"></i></button>
                                            <button type="button" data-id="{{ $employment->id }}" class="icon-btn bg--1 text-white deleteEmployment"><i class="las la-trash text-white"></i></button>
                                        </td>
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
                    </div>
                </div>
            </div>
    </section>


<div id="employment" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Employment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.employment.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="company" class="form-control-label font-weight-bold">@lang('Company')</label>
                            <input type="text" class="form-control" id="company" maxlength="70" name="company" value="{{old('company')}}" placeholder="@lang('Enter Company')" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="designation" class="form-control-label font-weight-bold">@lang('Job Designation')</label>
                            <input type="text" class="form-control" id="designation" maxlength="100" name="designation" value="{{old('subject')}}" placeholder="@lang('Enter Job Designation')" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="city" class="form-control-label font-weight-bold">@lang('City')</label>
                            <input type="text" class="form-control" id="city" name="city" maxlength="100" value="{{old('City')}}" placeholder="@lang('City')" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="Country" class="form-control-label font-weight-bold">@lang('Country')</label>
                            <select class="form-control" name="country" id="country">
                                @include('partials.country')
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="start_date" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('start_date') }}" placeholder="@lang('Select Start Date')" autocomplete="off" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="end_date" class="form-control-label font-weight-bold">@lang('End Date')</label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('start_date') }}" placeholder="@lang('Select Date Date')" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn bg--5 text-white">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>


 <div id="editemploymentHistory" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update Employment History')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.employment.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="company" class="form-control-label font-weight-bold">@lang('Company')</label>
                                <input type="text" class="form-control" id="company" maxlength="70" name="company" value="{{old('company')}}" placeholder="@lang('Enter Company')" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="designation" class="form-control-label font-weight-bold">@lang('Job Designation')</label>
                                <input type="text" class="form-control" id="designation" maxlength="100" name="designation" value="{{old('subject')}}" placeholder="@lang('Enter Job Designation')" required>
                            </div>
                        </div>

                      <div class="row">
                          <div class="form-group col-lg-6">
                              <label for="city" class="form-control-label font-weight-bold">@lang('City')</label>
                              <input type="text" class="form-control" id="city" name="city" maxlength="100" value="{{old('City')}}" placeholder="@lang('City')" required>
                          </div>

                          <div class="form-group col-lg-6">
                              <label for="Country" class="form-control-label font-weight-bold">@lang('Country')</label>
                              <select class="form-control" name="country" id="country">
                                  @include('partials.country')
                              </select>
                          </div>
                      </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="start_date" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('start_date') }}" placeholder="@lang('Select Start Date')" autocomplete="off" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="end_date" class="form-control-label font-weight-bold">@lang('End Date')</label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('start_date') }}" placeholder="@lang('Select End Date')" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn bg--5 text-white">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="deleteEmployment" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Delete Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('user.employment.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this employment history?')</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                   <button type="submit" class="btn bg--5 text-white">@lang('Delete')</button>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/datepicker.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
<script>
    'use strict';
    (function($){
        $('.addEducation').on('click', function () {
            var modal = $('#education');
            modal.modal('show');
        });

        $('.datepicker-here').datepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoApply: true,
            autoClose: true,
        });

        $('.addemployment').on('click', function () {
            var modal = $('#employment');
            modal.modal('show');
        });

        $('.editbtnemployment').on('click', function () {
            var modal = $('#editemploymentHistory');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=company]').val($(this).data('company'));
            modal.find('input[name=designation]').val($(this).data('designation'));
            modal.find('input[name=city]').val($(this).data('city'));
            modal.find('select[name=country]').val($(this).data('country'));
            modal.find('input[name=start_date]').val($(this).data('start_date'));
            modal.find('input[name=end_date]').val($(this).data('end_date'));
            modal.find('textarea[name=description]').val($(this).data('description'));
            modal.modal('show');
        });

      $('.deleteEmployment').on('click', function () {
          var modal = $('#deleteEmployment');
          modal.find('input[name=id]').val($(this).data('id'));
          modal.modal('show');
      });
    })(jQuery)

</script>
@endpush



@push('style')
  <style>
    .datepickers-container {
      z-index: 999999;
    }
    .datepicker-inline {
      display: none !important;
    }
    .iti {
        width: calc(100%);
        position: relative;
    }
  </style>
@endpush
