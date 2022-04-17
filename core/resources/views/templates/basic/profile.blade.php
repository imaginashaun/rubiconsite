@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 pr-lg-5">
        <div class="profile-sidebar">
          <div class="thumb">
            @if($journalist->isOnline())
              <span class="badge badge-pill bg-success online-status text-light"><b>@lang('Online')</b></span>
            @else
              <span class="badge badge-pill bg-warning online-status text-dark"><b>@lang('Offline')</b></span>
            @endif
            <img src="{{ getImage('assets/images/user/profile/'. $journalist->image)}}" alt="image" class="w-100">
          </div>
          <div class="ratings text-center py-3">
            @if($journalist->rating == 1)
              <i class="las la-star"></i>
            @elseif($journalist->rating == 2)
              <i class="las la-star"></i>
              <i class="las la-star"></i>
            @elseif($journalist->rating == 3)
              <i class="las la-star"></i>
              <i class="las la-star"></i>
              <i class="las la-star"></i>
            @elseif($journalist->rating == 4)
              <i class="las la-star"></i>
              <i class="las la-star"></i>
              <i class="las la-star"></i>
              <i class="las la-star"></i>
            @elseif($journalist->rating == 5)
              <i class="las la-star"></i>
              <i class="las la-star"></i>
              <i class="las la-star"></i>
              <i class="las la-star"></i>
              <i class="las la-star"></i>
            @else
              <i class="las la-star"></i>
            @endif
              <span class="text-dark">({{ $journalist->rating }})</span>

          </div>
          @auth
            @if($ratingGet)
              <div class="text-center">
                <a href="javascript:void(0)" class="cmn-btn btn-sm rate_now">@lang('Rate Now')</a>
              </div>
              <form class="rating rating_form" action="{{ route('user.member.rating') }}" method="POST">
                @csrf
                <input type="hidden" name="journalist_id" value="{{ $journalist->id }}">
                <div class="review-form-group d-flex flex-wrap justify-content-between align-items-center">
                  <label class="review-label mb-0 mr-3 mt-2">@lang('Your Ratings') :</label>
                  <div class="rating-form-group mt-2">
                      <label class="star-label">
                          <input type="radio" name="rating" value="1"/>
                          <span class="icon"><i class="las la-star"></i></span>
                      </label>
                      <label class="star-label">
                          <input type="radio" name="rating" value="2"/>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                      </label>
                      <label class="star-label">
                          <input type="radio" name="rating" value="3"/>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                      </label>
                      <label class="star-label">
                          <input type="radio" name="rating" value="4"/>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                      </label>
                      <label class="star-label">
                          <input type="radio" name="rating" value="5"/>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                          <span class="icon"><i class="las la-star"></i></span>
                      </label>
                  </div>
                  <button type="submit" class="cmn-btn btn-sm ml-auto mt-2">@lang('Confirm')</button>
              </div>
              </form>
            @endif
        @endauth
          <div class="details text-center">
            <h4 class="mb-2">{{__($journalist->username) }}</h4>
            <h6 class="mb-2">{{__($journalist->designation) }}</h6>
            <p><i class="fas fa-map-marker-alt"></i> {{__(@$journalist->address->city)}}, {{__($journalist->address->country) ?? '' }}</p>
            @guest
              <a href="{{route('user.login')}}" class="pay-btn d-block btn-md mt-4"><i class="far fa-envelope mr-2"></i>@lang('Contact')</a>
            @endguest
            @auth
              @if(empty($conversion))
                <a href="#0" class="pay-btn d-block btn-md mt-4 messageBtn"><i class="far fa-envelope mr-2"></i>@lang('Contact')</a>
              @else
                <a href="{{ route('user.message.inbox') }}" class="pay-btn d-block btn-md mt-4"><i class="far fa-envelope mr-2"></i>@lang('Inbox')</a>
              @endif
            @endauth
            <a href="{{ route('user.member.booking', $journalist->username) }}" class="cmn-btn d-block mt-3"><i class="fas fa-user-check mr-2"></i>@lang('Hire Me Now')</a>
          </div>
          <div class="sidebar-block">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <b>@lang('Total Complete Job')</b>
                <span class="">{{__($job_complete) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <b>@lang('Inprogress Job')</b>
                <span class="">{{__($job_progress) }}</span>
              </li>

            </ul>
          </div>
          <div class="sidebar-block">
            <h4 class="title">@lang('Skills')</h4>
            <ul class="skill-list">
              @if(!empty($journalist->language))
                @forelse ($journalist->skill as $work_skill)
                  <li>{{__($work_skill) }}</li>
                @empty

                @endforelse
              @endif
            </ul>
          </div><!-- sidebar-block end -->
          <div class="sidebar-block">
            <h4 class="title">@lang('Language')</h4>
            <ul class="skill-list">
              @if(!empty($journalist->language))
                @forelse ($journalist->language as $key => $lan)
                    <li>{{__($lan) }}</li>
                @empty
                    <li>@lang('Language No Select')</li>
                @endforelse
              @endif

            </ul>
          </div>
          <div class="sidebar-block">
            <h4 class="title">@lang('Education')</h4>
            <ul class="content-list">
              @forelse ($journalist->education as $edu)
                <li class="single">
                  <span class="caption">{{ $edu->school }} ({{$edu->subject}})</span>
                  <p class="my-2">({{showDateTime($edu->from_year, 'F Y') }} - {{showDateTime($edu->to_year, 'F Y')}})</p>
                </li>
              @empty

              @endforelse
            </ul>
          </div>

          <div class="sidebar-block">
            <h4 class="title">@lang('Employment History')</h4>
            <ul class="content-list">
              @forelse ($journalist->employment as $emp)
                <li class="single">
                  <span class="caption">{{__($emp->company)}}</span>
                  <p>{{__(@$emp->designation)}}</p>
                  <p>{{ @$emp->city }}, {{__($emp->country) }}</p>
                  <p class="my-2">
                    ({{ showDateTime($emp->start_date, 'F Y') }} -
                      {{ showDateTime($emp->end_date, 'F Y')}} )
                  </p>
                </li>
              @empty

              @endforelse
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-8 mt-lg-0 mt-5">
        <div class="profile-content">
          <div class="profile-content__block">
            <h4 class="title">@lang('About Profession')</h4>
            <p>{{__($journalist->about_profession) }}</p>
          </div>
        </div>

        <div class="row mt-50 mb-none-30">
          @forelse($journalist_work as $work)
            <div class="col-xl-4 col-md-6 mb-30">
              <div class="story-card">
                <div class="story-card__thumb">
                  @if(!empty($work->image))
                  <img src="{{ getImage('assets/images/workFile/'. $work->image) }}" alt="image">
                  @elseif(!empty($work->video_file))
                      <img src="{{ getImage('assets/images/workFile/background/'. $work->background_image) }}" alt="image">
                      <a href="{{ $work->video_file }}" data-rel="lightcase:myCollection" class="video-button"><i class="las la-play"></i></a>
                  @elseif(!empty($work->audio_file))
                    <audio
                      controls
                      src="{{ asset('assets/audio/'. $work->audio_file )}}">
                    </audio>
                  @elseif(!empty($work->blog_link))
                    <a href="{{ $work->blog_link }}" target="_blank">{{ $work->blog_link }}</a>
                  @endif
                </div>
                <div class="story-card__content">
                  <h6 class="story-card__title mb-3"><a href="{{ route('journalist.work.details', $work->id) }}">{{ Str::words($work->title, 6) }}</a></h6>
                  <p>{{ Str::words($work->descripation, 10)}}</p>
                  <a href="{{ route('journalist.work.details', $work->id) }}" class="cmn-btn btn-sm mt-3">@lang('Read More')</a>
                </div>
              </div>
            </div>
          @empty

          @endforelse
        </div>
          {{ $journalist_work->links() }}
        </div>
      </div>
    </div>
</section>


 <div id="message" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Start Conversation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.message.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $journalist->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message" class="form-control-label font-weight-bold">@lang('Message')</label>
                        <textarea class="form-control" rows="4" name="message" placeholder="@lang('Message')">{{ old('message') }}</textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn bg--5 text-white">@lang('Message')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
  <script>
    'use strict';
      $('.messageBtn').on('click', function () {
          var modal = $('#message');
          modal.modal('show');
      });
  </script>
@endpush
