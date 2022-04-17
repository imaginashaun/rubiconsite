@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="text-right my-2">
                  <a href="{{route('ticket.open') }}" class="btn bg--6 text-white">
                      <i class="fa fa-plus"></i>@lang('New Ticket')
                  </a>
                </div>
                  <div class="card">
                      <div class="card-body table-responsive p-0">
                        <table class="table style--two white-space-nowrap">
                            <thead >
                                <tr>
                                    <th scope="col">@lang('Subject')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Last Reply')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                                <tbody>
                                @forelse($supports as $key => $support)
                                    <tr>
                                        <td data-label="@lang('Subject')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ $support->subject }} </a></td>
                                        <td data-label="@lang('Status')">
                                            @if($support->status == 0)
                                                <span class="badge text-white badge--pending">@lang('Open')</span>
                                            @elseif($support->status == 1)
                                                <span class="badge text-white badge--completed">@lang('Answered')</span>
                                            @elseif($support->status == 2)
                                                <span class="badge text-white badge--deliverd">@lang('Customer Reply')</span>
                                            @elseif($support->status == 3)
                                                <span class="badge text-white badge--cancel">@lang('Closed')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('ticket.view', $support->ticket) }}" class="btn bg--2 text-white btn-sm">
                                                <i class="fa fa-desktop"></i>
                                            </a>
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
                            {{$supports->links()}}
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

