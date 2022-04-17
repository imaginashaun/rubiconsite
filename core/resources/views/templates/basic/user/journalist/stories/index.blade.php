@extends($activeTemplate .'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
               <div class="card">
                 <div class="card-body table-responsive p-0">
                   <table class="table style--two white-space-nowrap">
                    <thead>
                      <tr>
                        <th>@lang('Title')</th>
                        <th>@lang('Category')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($stories as $story)
                        <tr>
                          <td data-label="@lang('Title')">
                            <div class="gig-info">
                                <div class="thumb"> <img src="{{getImage('assets/images/stories/'. $story->image)}}" alt="image"></div>
                                <div class="content">{{ Str::words($story->title,10) }}</div>
                            </div>
                          </td>
                          <td data-label="Category">{{$story->category->name}}</td>
                          <td data-label ="@lang('Status')">
                             @if($story->status == 1)
                                   <span class="badge text-white badge--completed">@lang('Approved')</span>
                              @elseif($story->working_status == 0)
                                   <span class="badge text-white badge--pending">@lang('Pending')</span>
                              @endif
                          </td>
                          <td data-label="@lang('Action')">
                            <a href="{{ route('user.storie.edit', $story->id) }}" class="icon-btn bg--2"><i class="fas fa-pencil-alt text-white"></i></a>
                            <a href="{{ route('user.storie.details',[$story->id, str_slug($story->title)]) }}" class="icon-btn bg--5"><i class="las la-info-circle text-white"></i></a>
                             <a href="#" data-id="{{ $story->id }}" class="icon-btn bg--1 deleteBtn"><i class="las la-trash text-white"></i></a>
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
           {{ $stories->links() }}
        </div>
      </div>
    </div>
</section>

<div id="deleteStory" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Delete Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('user.storie.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this story?')</p>
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
        $(".deleteBtn").on('click', function(){
             var modal = $('#deleteStory');
             modal.find('input[name=id]').val($(this).data('id'));
             modal.modal('show');
        });
      })(jQuery)
  </script>
@endpush

