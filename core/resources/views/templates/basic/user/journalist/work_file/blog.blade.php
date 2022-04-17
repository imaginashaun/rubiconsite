@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
             <div class="text-right my-2">
               <button type="button" class="btn bg--6 text-white blogbtn"><i class="las la-plus"></i> @lang('Add Work')</button>
             </div>
             <div class="card">
               <div class="card-body table-responsive--lg p-0">
                 <table class="table style--two white-space-nowrap">
                   <thead>
                     <tr>
                       <th>@lang('Title')</th>
                       <th>@lang('Blog Link')</th>
                       <th>@lang('Status')</th>
                       <th>@lang('Action')</th>
                     </tr>
                   </thead>
                   <tbody>
                     @forelse ($blog as $key => $value)
                       <tr>
                         <td data-label="@lang('Title')">{{ Str::words($value->title, 10) }}</td>
                         <td data-label="@lang('Blog Link')"><a class="btn bg--5 text-white btn-sm" href="{{ $value->blog_link }}" target="_blank">@lang('Blog Link')</a></td>
                         <td data-label="@lang('Status')">
                           @if($value->status == 1)
                             <span class="badge text-white badge--completed">@lang('Approved')</span>
                           @else
                             <span class="badge text-white badge--pending">@lang('Pending')</span>
                           @endif
                         </td>
                         <td data-label="@lang('Action')">
                           <a href="#0" class="icon-btn bg--2 text-white updateBlogModal" data-id="{{ $value->id }}" data-blog_link = "{{ $value->blog_link }}" data-title = "{{ $value->title }}" data-descripation="{{ $value->descripation }}"><i class="fas fa-pencil-alt text-white"></i></a>
                           <a href="{{ route('user.blog.work.details', $value->id) }}" class="icon-btn bg--5 text-white"><i class="las la-info-circle text-white"></i></a>
                            <a href="#" data-id="{{ $value->id }}" class="icon-btn bg--1 deleteBtn"><i class="las la-trash text-white"></i></a>
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
             {{ $blog->links() }}
           </div>
         </div>
       </div>
     </section>

<div id="blogModal" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Add Blog Work')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('user.uploade.work')}}" method="POST">
               @csrf
               <input type="hidden" name="blog" value="blog">
               <div class="modal-body">
                 <div class="form-group">
                     <label for="name" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="name" maxlength="250" name="title" value="{{old('title')}}" placeholder="Enter Title" required>
                 </div>

                <div class="form-group">
                   <label for="name" class="form-control-label font-weight-bold"> @lang('Blog Link') <span class="text-danger">*</span></label>
                   <input type="text" class="form-control" id="name" maxlength="200" name="blog_link" value="{{old('blog_link')}}" placeholder="Blog Url" required>
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


<div id="updateBlogModal" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Update Blog Work')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('user.uploade.work.update')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="blog" value="blog">
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                 <div class="form-group">
                     <label for="name" class="form-control-label font-weight-bold">@lang('Title') <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="name" maxlength="250" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required>
                 </div>

                <div class="form-group">
                   <label for="name" class="form-control-label font-weight-bold"> @lang('Blog Link') <span class="text-danger">*</span></label>
                   <input type="text" class="form-control" id="name" maxlength="200" name="blog_link" value="{{old('blog_link')}}" placeholder="@lang('Blog Url')" required>
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


<div id="deleteBlog" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Delete Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('user.blog.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this blog?')</p>
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
        $('.blogbtn').on('click', function () {
            var modal = $('#blogModal');
            modal.modal('show');
        });

        $(".deleteBtn").on('click', function(){
             var modal = $('#deleteBlog');
             modal.find('input[name=id]').val($(this).data('id'));
             modal.modal('show');
        });

        $('.updateBlogModal').on('click', function () {
            var modal = $('#updateBlogModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=title]').val($(this).data('title'));
            modal.find('input[name=blog_link]').val($(this).data('blog_link'));
            modal.find('textarea[name=descripation]').val($(this).data('descripation'));
            modal.modal('show');
        });
      })(jQuery)
  </script>
@endpush
