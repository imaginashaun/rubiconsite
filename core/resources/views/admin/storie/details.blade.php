@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="mt-2 text-center">@lang('Story Image')</div>
                    <div class="p-3 bg--white">
                        <img src="{{ getImage('assets/images/stories/'. $storie->image)}}" alt="profile-image"
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
                            <span class="font-weight-bold">{{$storie->journalist->username}}</span>
                        </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Account Approval Status')
                            @switch($storie->journalist->account_status)
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
                            @switch($storie->journalist->status)
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
                            @if($storie->journalist->isOnline())
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
                    <div class="card-title my-2"><b>@lang('Category')</b></div>
                    <h5>{{$storie->category->name}}</h5>
                    <div class="card-title my-2"><b>@lang('Title')</b></div>
                    <h5>{{$storie->title}}</h5>
                    <div class="card-title my-2"><b>@lang('Description') </b></div>
                    <div class="card-text">@php echo $storie->description @endphp</div>
                </div>
            </div>
        </div>
    </div>
@endsection
