@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="text-right my-2">
                   <button type="button" class="btn bg--6 text-white addEducation">@lang('Add New') <i class="las la-plus"></i></button>
                </div>
                  <div class="card">
                      <div class="card-body table-responsive--lg p-0">
                        <table class="table style--two white-space-nowrap">
                            <thead >
                                <tr>
                                    <th scope="col">@lang('Id')</th>
                                    <th scope="col">@lang('School')</th>
                                    <th scope="col">@lang('Subject')</th>
                                    <th scope="col">@lang('Start Date')</th>
                                    <th scope="col">@lang('End Date')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                                <tbody>
                                @forelse($educations as  $education)
                                    <tr>
                                        <td data-label="@lang('Id')">{{$loop->iteration }}</td>
                                        <td data-label="@lang('School')">{{$education->school}}</td>
                                        <td data-label="@lang('Subject')">{{$education->subject}}</td>
                                        <td data-label="@lang('Start')">{{showDateTime($education->from_year, 'd M Y')}}</td>
                                        <td data-label="@lang('End')">{{showDateTime($education->to_year, 'd M Y')}}</td>
                                        <td data-label="@lang('Action')">
                                          <button type="button" data-id="{{ $education->id }}" data-school="{{ $education->school }}" data-subject="{{ $education->subject }}" data-from_year ="{{ $education->from_year}}" data-to_year="{{ $education->to_year}}" data-description="{{ $education->description }}" class="icon-btn bg--2 text-white editbtnEducation"><i class="las la-edit"></i></button>
                                          <a href="#" data-id="{{ $education->id }}" class="icon-btn bg--1 text-white deleteEducation"><i class="las la-trash text-white"></i></a>
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


 <div id="education" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Education')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.education.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                      <label for="school" class="form-control-label font-weight-bold">@lang('Academic Degree Name') </label>
                      <input type="text" class="form-control" id="school" maxlength="150" name="school" value="{{old('school')}}" placeholder="@lang('Enter academic degree')" required>
                  </div>

                  <div class="form-group">
                      <label for="subject" class="form-control-label font-weight-bold">@lang('Subject')</label>
                      <input type="text" class="form-control" id="subject" maxlength="250" name="subject" value="{{old('subject')}}" placeholder="@lang('Enter Subject')" required>
                  </div>

                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="from_year" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                          <input type="text" name="from_year" id="from_year" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('from_year') }}" placeholder="@lang('Select Start Year')" autocomplete="off">
                      </div>
                      <div class="form-group col-lg-6">
                          <label for="to_year" class="form-control-label font-weight-bold">@lang('Graduation Year')</label>
                          <input type="text" name="to_year" id="to_year" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('to_year') }}" placeholder="@lang('Select Graduation Year')" autocomplete="off">
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




 <div id="Editeducation" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Edit Education')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.education.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" name="id">
                <div class="modal-body">
                  <div class="form-group">
                      <label for="school" class="form-control-label font-weight-bold">@lang('Academic Degree Name')</label>
                      <input type="text" class="form-control" id="school" maxlength="150" name="school" value="{{old('school')}}" placeholder="Enter School" required>
                  </div>

                  <div class="form-group">
                      <label for="subject" class="form-control-label font-weight-bold">@lang('Subject')</label>
                      <input type="text" class="form-control" id="subject" maxlength="250" name="subject" value="{{old('subject')}}" placeholder="Enter Subject" required>
                  </div>

                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="from_year" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                          <input type="text" name="from_year" id="from_year" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('from_year') }}" placeholder="@lang('Select Start Year')" autocomplete="off" required>
                      </div>
                      <div class="form-group col-lg-6">
                          <label for="to_year" class="form-control-label font-weight-bold">@lang('Graduation Year')</label>
                         <input type="text" name="to_year" id="to_year" class="form-control datepicker-here" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ old('to_year') }}" placeholder="@lang('Select Start Year')" autocomplete="off" required>

                      </div>
                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn bg--5 text-white">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="deleteEdu" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Delete Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('user.education.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this education?')</p>
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

      $('.editbtnEducation').on('click', function () {
          var modal = $('#Editeducation');
          modal.find('input[name=id]').val($(this).data('id'));
          modal.find('input[name=school]').val($(this).data('school'));
          modal.find('input[name=subject]').val($(this).data('subject'));
          modal.find('input[name=from_year]').val($(this).data('from_year'));
          modal.find('input[name=to_year]').val($(this).data('to_year'));
          modal.find('textarea[name=description]').val($(this).data('description'));
          modal.modal('show');
      });

      $('.deleteEducation').on('click', function () {
          var modal = $('#deleteEdu');
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
