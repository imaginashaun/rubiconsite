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
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Journalist Name')</th>
                                <th scope="col">@lang('Blog Link')</th>
                                <th scope="col">@lang('Date & Time')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>

                        @forelse($blogs as $value)
                            <tr>
                                <td data-label="@lang('Id')">{{$loop->iteration}}</td>
                                <td data-label="@lang('Title')">{{ Str::words($value->title, 5) }}</td>
                                 <td data-label="@lang('Username')"><a href="{{ route('admin.users.detail', $value->user_id) }}">{{ $value->user->username }}</a></td>
                                <td data-label="@lang('Blog Link')">
                                  <a href="{{$value->blog_link}}" target="_blank" class="btn btn--primary btn--sm">@lang('Click')</a>
                                </td>
                                <td data-label="@lang('Date & Time')">{{ showDateTime($value->created_at) }}</td>
                                <td data-label="@lang('Status')">
                                    @if($value->status == 1)
                                        <span class="font-weight-normal  badge--success">@lang('Approved')</span>
                                    @elseif($value->status == 0)
                                        <span class="font-weight-normal  badge--primary">@lang('Pending')</span>
                                    @elseif($value->status == 2)
                                        <span class="font-weight-normal  badge--danger">@lang('Cancel')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                  <a href="{{route('admin.work.blog.detail', $value->id)}}" class="icon-btn btn--primary ml-2" data-toggle="tooltip" title="" data-original-title="Details">
                                    <i class="las la-desktop"></i>
                                  </a>
                                  @if($value->status == 0)
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
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $blogs->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
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
           <form action="{{route('admin.work.blog.delete')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to delete this blog?')</p>
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
           <form action="{{route('admin.work.blog.approvedBy')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="">
               <div class="modal-body">
                   <p>@lang('Are you sure want to accept this blog?')</p>
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
