@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
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
                                    <th>@lang('Video')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                        <tbody>
                        @forelse ($video_file as $key => $video)
                            <tr>
                                <td data-label="@lang('Title')">
                                    <div class="gig-info">
                                        <div class="thumb"> <img src="{{ asset('assets/images/workFile/background/'. $video->background_image) }}" alt="image"></div>
                                        <div class="content">{{ Str::words($video->title,8) }}</div>
                                    </div>
                                </td>
                               <td data-label="@lang('Video')"><a href="{{ $video->video_file }}" data-rel="lightcase:myCollection" class="btn badge--paid text-white"><i class="las la-play"></i></a></td>
                                <td data-label="@lang('Status')">
                                    @if($video->status == 1)
                                        <span class="badge text-white badge--completed">@lang('Approved')</span>
                                    @else
                                        <span class="badge text-white badge--pending">@lang('Pending')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="#" data-id="{{ $video->id }}" data-title="{{ $video->title }}" data-descripation="{{ $video->descripation }}" data-video_file="{{ $video->video_file }}" class="icon-btn bg--2 updateVideoBtn"><i class="las la-edit text-white"></i></a>
                                    <a href="{{ route('user.video.work.details', $video->id) }}" class="icon-btn bg--5"><i class="las la-info-circle text-white"></i></a>
                                    <a href="#" data-id="{{ $video->id }}" class="icon-btn bg--1 deleteBtn"><i class="las la-trash text-white"></i></a>
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
            {{ $video_file->links() }}
        </div>
    </div>
</div>
</section>

<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Add video work')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('user.uploade.work')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="video" value="video">
               <div class="modal-body">
                   <div class="form-group">
                       <label for="name" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" id="name" maxlength="250" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required>
                   </div>

                   <div class="form-group">
                       <label for="video_link" class="form-control-label font-weight-bold"> @lang('Video Link') <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" id="video_link" maxlength="200" name="video_link" value="{{old('video_link')}}" placeholder="@lang('Youtube Embed Url')" required>
                       <small>@lang('Support Link : https://www.youtube.com/embed/example')</small>
                   </div>

                <div class="form-group">
                    <label class="form-control-label font-weight-bold">@lang('Background Image') <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">@lang('Upload')</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="background_image" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">@lang('Choose Image')</label>
                        </div>
                    </div>
                </div>

                   <div class="form-group">
                       <label for="status" class="form-control-label font-weight-bold">@lang('Descripation') <span class="text-danger">*</span></label>
                       <textarea class="form-control" rows="4" name="descripation" placeholder="@lang('Enter Description')">{{ old('descripation') }}</textarea>
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


<div id="updateVideoBtn" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Update Video Work')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('user.uploade.work.update')}}" method="POST" enctype="multipart/form-data">
               @csrf
                <input type="hidden" name="video" value="video">
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <div class="form-group">
                       <label for="name" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>
                       <input type="text" class="form-control form-control-lg" id="name" maxlength="250" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required>
                   </div>

                   <div class="form-group">
                       <label for="name" class="form-control-label font-weight-bold">@lang('Video Link')<span class="text-danger">*</span></label>
                       <input type="text" class="form-control form-control-lg" id="name" maxlength="200" name="video_link" value="{{old('video_link')}}" placeholder="@lang('Youtube Link Url')" required>
                       <small>@lang('Support Link : https://www.youtube.com/embed/example')</small>
                   </div>

                   <div class="form-group">
                      <label class="form-control-label font-weight-bold">@lang('Background Image') <span class="text-danger">*</span></label>
                     <div class="input-group mb-3">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="inputGroupFileAddon01">@lang('Upload')</span>
                       </div>
                       <div class="custom-file">
                         <input type="file" class="custom-file-input" id="inputGroupFile01" name="background_image" aria-describedby="inputGroupFileAddon01">
                         <label class="custom-file-label" for="inputGroupFile01">@lang('Choose Image')</label>
                       </div>
                      </div>
                  </div>

                   <div class="form-group">
                       <label for="status" class="form-control-label font-weight-bold">@lang('Descripation') <span class="text-danger">*</span></label>
                       <textarea class="form-control" rows="4" name="descripation">{{ old('descripation') }}</textarea>
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

<div id="deleteVideo" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Delete Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('user.video.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this video?')</p>
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
        $(".addVideoBtn").on('click', function(){
             var modal = $('#addModal');
             modal.modal('show');
        });

        $(".deleteBtn").on('click', function(){
            var modal = $('#deleteVideo');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('.updateVideoBtn').on('click', function () {
          var modal = $('#updateVideoBtn');
          modal.find('input[name=id]').val($(this).data('id'));
          modal.find('input[name=title]').val($(this).data('title'));
          modal.find('input[name=video_link]').val($(this).data('video_file'));
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
