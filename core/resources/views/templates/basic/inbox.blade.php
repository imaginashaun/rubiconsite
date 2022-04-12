@extends(auth()->user()->user_type == 'member' ? $activeTemplate.'layouts.member' : $activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><h6>@lang('Inbox')</h6></div>
            <div class="card-body p-0">
                <ul class="chat_area">
                    @forelse($conversions as $conversion)
                        @if($conversion->sender_id != auth()->user()->id)
                            <li>
                                <div class="chat_author">
                                    <div class="thumb">
                                        <img src="{{getImage('assets/images/user/profile/'. $conversion->sender->image, '350x300')}}" />
                                    </div>
                                    <div class="content">
                                        <h6 class="title">
                                            <a href="{{route('user.message.chat', $conversion->id)}}">{{$conversion->sender->username}}</a>
                                        </h6>
                                        <span class="info">{{$conversion->messages->last()->message}}</span>
                                    </div>
                                </div>
                                <div class="date_area">
                                    <span>{{diffforhumans($conversion->messages->last()->created_at)}}</span>
                                </div>
                            </li>
                        @else
                            <li>
                                <div class="chat_author">
                                    <div class="thumb">
                                        <img src="{{getImage('assets/images/user/profile/'. $conversion->receiver->image, '350x300')}}" />
                                    </div>
                                    <div class="content">
                                        <h6 class="title">
                                            <a href="{{route('user.message.chat', $conversion->id)}}">{{$conversion->receiver->username}}</a>
                                        </h6>
                                        <span class="info">{{$conversion->messages->last()->message}}</span>
                                    </div>
                                </div>
                                <div class="date_area">
                                    <span>{{diffforhumans($conversion->messages->last()->created_at)}}</span>
                                </div>
                            </li>
                        @endif
                    @empty
                      <div class="text-center">
                            <div class="inbox-empty">
                                <h4 class="title">@lang('Empty Conversation')</h4>
                            </div>
                      </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection


@push('style')
<style>
    .chat_area .inbox-empty {
        min-height: 200px;
        position: relative;
        padding-top: 40px;
    }
    .chat_area .inbox-empty::after {
        position: absolute;
        content: "\f07c";
        font-family: 'Line Awesome Free';
        font-weight: 900;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -44%);
        color: #d0d0d0;
        font-size: 80px;
    }
    .chat_area .inbox-empty .title {
        text-align: center;
        color: #d0d0d0;
    }
</style>
@endpush
