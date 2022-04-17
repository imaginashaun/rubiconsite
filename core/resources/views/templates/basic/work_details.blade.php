@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
  <div class="container">
    <div class="row">
            <div class="col-lg-8">
                <article>
                    <div class="post-item post-classic post-details mb-0">
                        <div class="post-thumb c-thumb">
                            @if(!empty($work_details->image))
                              <img src="{{ getImage('assets/images/workFile/'. $work_details->image)}}" alt="blog">
                            @elseif(!empty($work_details->video_file))
                                <a href="#0" class="d-block ml-auto mr-auto" ><img src="{{ getImage('assets/images/workFile/background/'.$work_details->background_image) }}" alt="image"></a>
                                <a href="{{ $work_details->video_file }}" data-rel="lightcase:myCollection" class="video-button"><i class="las la-play"></i></a>
                            @elseif(!empty($work_details->audio_file))
                              <div class="text-center">
                                <audio
                                  controls
                                  src="{{ asset('assets/audio/'. $work_details->audio_file )}}">
                                </audio>
                              </div>
                            @elseif(!empty($work_details->blog_link))
                              <a href="{{ $work_details->blog_link }}" target="_blank">{{ $work_details->blog_link }}</a>
                            @endif
                        </div>
                        <div class="post-content">
                            <div class="blog-header">
                                <h4 class="title">
                                  {{ __($work_details->title) }}
                                </h4>
                            </div>
                            <div class="meta-post">
                                <div class="meta-author">
                                    <div class="thumb">
                                      <a href="{{ route('profile', $work_details->user->username) }}" class="d-block"><img src="{{ getImage('assets/images/user/profile/'. $work_details->user->image)}}" alt="image"></a>
                                    </div>
                                    <h6 class="name"><a href="{{ route('profile', $work_details->user->username) }}">{{ __($work_details->user->username) }}</a></h6>
                                </div>
                                <div class="date">
                                    {{ \Carbon\Carbon::parse($work_details->created_at)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="entry-content">
                                <p>{{ __($work_details->descripation) }}</p>

                                <div class="tag-options justify-content-center">
                                    <div class="share">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href=" https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href=" http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <aside class="b-sidebar">
                    <div class="widget widget-post">
                        <h6 class="title">@lang('featured Journalist')</h6>
                        <ul>
                            @forelse($journalist as $value)
                            <li>
                                <div class="c-thumb">
                                    <a href="{{ route('profile', $value->username) }}">
                                        <img class="image-roundsd" src="{{ getImage('assets/images/user/profile/'. $value->image)}}" alt="blog">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title">
                                        <a href="{{ route('profile', $value->username) }}">{{ $value->username }}</a>
                                    </h6>
                                    <div class="meta">
                                      {{ __($value->designation) }}
                                    </div>
                                </div>
                            </li>
                          @empty
                          @endforelse
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
  </div>
@endsection
