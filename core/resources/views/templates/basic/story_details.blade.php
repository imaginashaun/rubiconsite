@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
  <div class="blog-section pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <div class="post-item post-classic post-details mb-0">
                        <div class="post-thumb c-thumb">
                            <img src="{{ getImage('assets/images/stories/'. $story->image, '874x478')}}" alt="@lang('Story Image')">
                        </div>
                        <div class="post-content">
                            <div class="blog-header">
                                <h4 class="title">
                                  {{ __($story->title) }}
                                </h4>
                            </div>
                            <div class="meta-post">
                                <div class="meta-author">
                                    <div class="thumb">
                                      <a href="{{ route('profile', $story->journalist->username) }}" class="d-block"><img src="{{ getImage('assets/images/user/profile/'. $story->journalist->image)}}" alt="image"></a>
                                    </div>
                                    <h6 class="name"><a href="{{ route('profile', $story->journalist->username) }}">{{ $story->journalist->username }}</a></h6>
                                </div>
                                <div class="date">
                                    {{ \Carbon\Carbon::parse($story->created_at)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="entry-content">
                                <p>{{ __($story->description) }}</p>

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
                <div class="fb-comments" data-width="100%"></div>
            </div>
            <div class="col-lg-4">
                <aside class="b-sidebar">
                    <div class="widget widget-category">
                        <h6 class="title">@lang('Categories')</h6>
                        <ul>
                          @forelse($categorys as $value)
                            <li>
                                <a href="{{ route('category.stories', $value->id) }}">{{ __($value->name) }}</a>
                            </li>
                          @empty
                          @endforelse
                        </ul>
                    </div>
                    <div class="widget widget-post">
                        <h6 class="title">@lang('recent stories')</h6>
                        <ul>
                            @forelse($recent_story as $value)
                            <li>
                                <div class="c-thumb">
                                    <a href="{{ route('story.details', [$value->id, str_slug($value->title)]) }}">
                                        <img src="{{ getImage('assets/images/stories/'. $value->image, '874x478')}}" alt="@lang('Story Image')">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title">
                                        <a href="{{ route('story.details', [$value->id, str_slug($value->title)]) }}">{{ Str::words($value->title, 6) }}</a>
                                    </h6>
                                    <div class="meta">
                                        @lang('Post by') - <a href="{{ route('profile', $value->journalist->username) }}"> {{ __($value->journalist->username) }}</a>
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
