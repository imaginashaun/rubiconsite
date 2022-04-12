@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="mt-2 text-center">@lang('Video Background Image')</div>
                    <div class="p-3 bg--white">
                        <img src="{{ getImage('assets/images/user/profile/'. $video->user->image)}}" alt="profile-image"
                            class="b-radius--10 w-100">
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Journalist Information')</h5>
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{$video->user->username}}</span>
                        </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Account Approval status')
                            @switch($video->user->account_status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Approved')</span>
                                @break
                                @case(0)
                                <span class="badge badge-pill bg--danger">@lang('Cancel')</span>
                                @break
                            @endswitch
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @switch($video->user->status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Active')</span>
                                @break
                                @case(2)
                                <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                                @break
                            @endswitch
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Online Status')
                            @if($video->user->isOnline())
                              <span class="badge badge-pill bg--success">@lang('Online')</span>
                            @else
                              <span class="badge badge-pill bg--warning">@lang('Offline')</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                       <a href="{{$video->video_file}}" data-rel="lightcase:myCollection" class="btn btn-bg btn--primary"><i class="las la-play"></i></a>
                    </div>
                    <div class="card-title my-4"><b>@lang('Title')</b></div>
                    <h4>{{__($video->title)}}</h4>
                    <div class="card-title my-4"><b>@lang('Description') </b></div>
                    <div class="card-text">@php echo $video->descripation @endphp</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    (function () {
        'use strict';
        $('a[data-rel^=lightcase]').lightcase(); 
    })();
</script>
@endpush