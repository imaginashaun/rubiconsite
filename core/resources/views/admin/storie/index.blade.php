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
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Journalist Username')</th>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Date & Time')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stories as $value)
                            <tr>
                                <td data-label="@lang('Title')">
                                  <div class="user">
                                      <div class="thumb">
                                          <img src="{{ getImage('assets/images/stories/'. $value->image,'350x300')}}" alt="image">
                                      </div>
                                      <span class="name">{{Str::words($value->title, 5)}}</span>
                                  </div>
                                </td>
                                <td data-label="@lang('Journalist')">
                                      <a href="{{ route('admin.users.detail', $value->user_id) }}">{{$value->journalist->username}}</a>
                                </td>
                                <td data-label="@lang('Category')">{{$value->category->name}}</td>
                                <td data-label="@lang('Date & Time')">{{ showDateTime($value->created_at) }}</td>
                                <td data-label="@lang('Status')">
                                    @if($value->status == 1)
                                        <span class="font-weight-normal  badge--success">@lang('Approved')</span>
                                    @elseif($value->status == 0)
                                        <span class="font-weight-normal  badge--primary">@lang('Pending')</span>
                                    @endif
                                </td>
                                <td data-label="Action">
                                  <a href="{{route('admin.stories.detail', $value->id)}}" class="icon-btn btn--primary ml-2" data-toggle="tooltip" title="" data-original-title="Approved">
                                    <i class="las la-desktop"></i>
                                  </a>
                                  @if(request()->routeIs('admin.stories.pending'))
                                     <button type="button" class="icon-btn btn--success ml-2 approvedbtn" data-id="{{$value->id}}" data-toggle="tooltip" title="" data-original-title="Approved">
                                            <i class="las la-check"></i>
                                      </button>
                                      <button type="button" class="icon-btn btn--danger ml-2 removeBtn" data-toggle="modal" data-target="#deleteVideo" data-id="{{$value->id}}">
                                          <i class="las la-trash"></i>
                                      </button>
                                  @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $stories->links('admin.partials.paginate') }}
                </div>
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
           <form action="{{route('admin.stories.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this story?')</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn--danger text-white" data-dismiss="modal">@lang('Close')</button>
                   <button type="submit" class="btn btn--success text-white">@lang('Delete')</button>
               </div>
           </form>
       </div>
   </div>
</div>


<div id="approvedVideo" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">@lang('Approval Confirmation')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{route('admin.stories.approvedBy')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to accept this story?')</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn--danger text-white" data-dismiss="modal">@lang('Close')</button>
                   <button type="submit" class="btn btn--success text-white">@lang('Approved')</button>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection


@push('breadcrumb-plugins')
    <form action="{{ route('admin.stories.search', $scope ?? str_replace('admin.stories.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="Username / Category" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush



@push('script')
<script>
    (function () {
        'use strict';
        $(".approvedbtn").on('click', function(){
            var modal = $('#approvedVideo');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

        $(".removeBtn").on('click', function(){
            var modal = $('#deleteVideo');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

    })();
</script>
@endpush
