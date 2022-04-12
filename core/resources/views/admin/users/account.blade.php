@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Journalist Information')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{$user->username}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Account Approval status')
                            @switch($user->account_status)
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
                            @switch($user->status)
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
                            @if($user->isOnline())
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
            <div class="card p-3">

                <div class="mt-3">
                    <h5 class="text-center">@lang('Main Service')</h5>
                    @if(!empty($user->service_id))
                     <p class="mt-2 text-center">{{ $user->service->name }}</p>
                    @else
                        <p class="mt-2 text-center">@lang('No Data')</p>
                    @endif
                </div>

                 <div class="mt-2">
                    <h5 class="text-center">@lang('About Profession')</h5>
                    @if(!empty($user->about_profession))
                        <p class="mt-2 text-center text-justify">{{$user->about_profession}}</p>
                    @else
                        <p class="mt-2 text-center">@lang('No Data')</p>
                    @endif
                </div>

                <div class="mt-2">
                    <h5 class="text-center">@lang('Skill')</h5>
                    @if(!empty($user->skill))
                        <ul class="skill-list justify-content-center mt-2">
                            @foreach($user->skill as $value)
                                <li>{{__($value)}}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-2 text-center">@lang('No Data')</p>
                    @endif
                </div>

                <div class="mt-2">
                    <h5 class="text-center">@lang('Language')</h5>
                    @if(!empty($user->language))
                        <ul class="skill-list justify-content-center mt-2">
                            @foreach($user->language as $value)
                                <li>{{__($value)}}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-2 text-center">@lang('No Data')</p>
                    @endif
                </div>

                

                <div class="card-body">
                    <h5 class="card-text my-2">@lang('Education History')</h5>
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('ID')</th>
                                <th scope="col">@lang('School')</th>
                                <th scope="col">@lang('Start Date')</th>
                                <th scope="col">@lang('End Date')</th>
                                <th scope="col">@lang('Subject')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($educations as $value)
                            <tr>
                                <td data-label="@lang('Id')">{{$loop->iteration}}</td>
                                <td data-label="@lang('School')">{{$value->school}}</td>
                                <td data-label="@lang('Start Date')">{{$value->from_year}}</td>
                                <td data-label="@lang('End Date')">{{$value->to_year}}</td>
                                <td data-label="@lang('subject')">{{$value->subject}}</td>
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

                <div class="card-body">
                    <h5 class="card-text my-2">@lang('Employments History')</h5>
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('ID')</th>
                                <th scope="col">@lang('Company')</th>
                                <th scope="col">@lang('Country')</th>
                                <th scope="col">@lang('City')</th>
                                <th scope="col">@lang('Designation')</th>
                                <th scope="col">@lang('Start Date')</th>
                                <th scope="col">@lang('End Date')</th>
                                <th scope="col">@lang('Subject')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($employments as $value)
                            <tr>
                                <td data-label="@lang('Id')">{{$loop->iteration}}</td>
                                <td data-label="@lang('Company')">{{$value->company}}</td>
                                <td data-label="@lang('Country')">{{$value->country}}</td>
                                <td data-label="@lang('City')">{{$value->city}}</td>
                                <td data-label="@lang('Designation')">{{$value->designation}}</td>
                                <td data-label="@lang('Start Date')">{{$value->to_year}}</td>
                                <td data-label="@lang('End Date')">{{$value->end_date}}</td>
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
            </div>
        </div>
    </div>
@endsection

@push('style')
<style>
    .skill-list {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin: -3px -5px;
    }
    .skill-list li {
        margin: 3px 5px;
        font-size: 14px;
        padding: 3px 10px;
        background-color: #f1f1f1;
        border-radius: 999px;
        -webkit-border-radius: 999px;
        -moz-border-radius: 999px;
        -ms-border-radius: 999px;
        -o-border-radius: 999px;
        border: 1px solid #e5e5e5;
    }
</style>
@endpush

