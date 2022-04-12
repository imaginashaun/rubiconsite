@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="text-right my-2">
                    <button type="button" class="btn bg--6 text-white addVideoBtn"><i class="las la-plus"></i> @lang('Add Work')</button>
                </div>
                <div class="card">
                    <div class="card-body table-responsive--lg p-0">
                        <table class="table style--two white-space-nowrap">
                            <thead>
                                <tr>
                                  <th>@lang('Title')</th>
                                  <th>@lang('Audio')</th>
                                  <th>@lang('Status')</th>
                                  <th>@lang('Action')</th>
                                </tr>
                         </thead>
                        <tbody>
                           @forelse ($audio_file as $key => $audio)
                            <tr>
                                <td data-label="@lang('Title')">{{ Str::words($audio->title, 10) }}</td>
                                <td data-label="@lang('Audio')">
                                  <audio controls src="{{ asset('assets/audio/'.$audio->audio_file )}}"></audio>
                                </td>
                                <td data-label="@lang('Status')">
                                  @if($audio->status == 1)
                                    <span class="badge text-white badge--completed">@lang('Approved')</span>
                                  @else
                                    <span class="badge text-white badge--pending">@lang('Pending')</span>
                                  @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="#0" class="icon-btn bg--2 updateAudioBtn" data-id="{{ $audio->id }}" data-title = "{{ $audio->title }}" data-descripation="{{ $audio->descripation }}"><i class="fas fa-pencil-alt text-white"></i></a>
                                    <a href="{{ route('user.audio.work.details', $audio->id) }}" class="icon-btn bg--5"><i class="las la-info-circle text-white"></i></a>
                                    <a href="#" data-id="{{ $audio->id }}" class="icon-btn bg--1 deleteBtn"><i class="las la-trash text-white"></i></a>
                                </td>
                            </tr>
                           @empty
                            <tr>
                               <td class="text-muted text-center" colspan="100%">@lang('No Data Found')</td>
                            </tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $audio_file->links() }}
        </div>
    </div>
</div>
</section>

<div id="audioModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">@lang('Upload Audio Work File')</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('user.uploade.work')}}" method="POST" enctype="multipart/form-data">
              @csrf
               <input type="hidden" name="audio" value="audio">
              <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" maxlength="250" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required>
                </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">@lang('Upload')</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile01" name="audio_file" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">@lang('Audio file')</label>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="status" class="form-control-label font-weight-bold">@lang('Descripation') <span class="text-danger">*</span></label>
                      <textarea class="form-control" rows="4" name="descripation" placeholder="Descripation">{{ old('descripation') }}</textarea>
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


 <div id="updateAudioModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update Audio Work')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.uploade.work.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="audio" value="audio">
                <input type="hidden" name="id" value="">
                <div class="modal-body">

                  <div class="form-group">
                      <label for="name" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" maxlength="250" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">@lang('Upload')</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile01" name="audio_file" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">@lang('Choose file')</label>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-control-label font-weight-bold">@lang('Descripation') <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" name="descripation">{{ old('descripation') }}</textarea>
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


<div id="deleteAudio" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Delete Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('user.audio.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this audio?')</p>
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

@push('script')
  <script>
     'use strict';
     (function($){
        $('.addVideoBtn').on('click', function () {
            var modal = $('#audioModal');
            modal.modal('show');
        });

        $(".deleteBtn").on('click', function(){
             var modal = $('#deleteAudio');
             modal.find('input[name=id]').val($(this).data('id'));
             modal.modal('show');
        });

        $('.updateAudioBtn').on('click', function () {
            var modal = $('#updateAudioModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=title]').val($(this).data('title'));
            modal.find('textarea[name=descripation]').val($(this).data('descripation'));
            modal.modal('show');
        });

        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
      })(jQuery)
  </script>
@endpush
