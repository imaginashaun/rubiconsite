@extends(auth()->user()->user_type == 'member' ? $activeTemplate.'layouts.member' : $activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
  <section class="pt-60 pb-60">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <div class="card card-bordered">
                <div class="card-header bg--6 text-white">
                    <h4 class="card-title"><strong>
                        @foreach($messages as $message)
                            @if($loop->first)
                                @if($message->sender_id != auth()->user()->id)
                                    {{$message->sender->username}}
                                @else
                                    {{$message->receiver->username}}
                                @endif
                            </strong>
                        </h4>
                    </div>

                    <div class="ps-container ps-theme-default ps-active-y chat-member" id="chat-content">
                            @endif
                            @if($message->sender_id != auth()->user()->id)
                                <div class="media media-chat"> <img class="avatar" src="{{getImage('assets/images/user/profile/'. $message->sender->image, '350x300')}}" alt="...">
                                    <div class="media-body">
                                        @if(!empty($message->message))
                                            <p>{{$message->message}}</p>
                                        @endif
                                        <br>
                                        @if(!empty($message->file))
                                            <img src="{{getImage('assets/images/message/'. $message->file)}}" alt="...">
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="media media-chat media-chat-reverse">
                                    <div class="media-body">
                                        @if(!empty($message->message))
                                            <p>{{$message->message}}</p>
                                        @endif
                                        <br>
                                        @if(!empty($message->file))
                                            <img src="{{getImage('assets/images/message/'. $message->file)}}" alt="...">
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($loop->last)
                                <div class="ps-scrollbar-x-rail" >
                                    <div class="ps-scrollbar-x" tabindex="0"></div>
                                </div>
                                <div class="ps-scrollbar-y-rail" >
                                    <div class="ps-scrollbar-y" tabindex="0"></div>
                                </div>
                                </div>
                                <form action="{{route('user.message.store.list')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method("POST")
                                    <div class="publisher bt-1 border-light">
                                        <div class="left">
                                            <img class="avatar avatar-xs" src="{{getImage('assets/images/user/profile/'. auth()->user()->image, '350x300')}}" alt="@lang('userImage')">
                                            @if($message->sender_id != auth()->user()->id)
                                                <input type="hidden" value="{{$message->sender_id}}" name="receiver_id">
                                            @else
                                                <input type="hidden" value="{{$message->receiver_id}}" name="receiver_id">
                                            @endif

                                            <input type="hidden" value="{{$message->conversion_id}}" name="conversion_id">

                                            <input class="publisher-input" type="text" name="message" placeholder="@lang('Message')">
                                        </div>
                                        <div class="right">
                                            <span class="publisher-btn file-group">
                                            <input type="file" name="image" id="data">
                                            <label for="data"><i class="fa fa-paperclip"></i></label>
                                            </span>
                                            <button type="submit" class="btn bg--5 text-white">@lang('Submit')</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
