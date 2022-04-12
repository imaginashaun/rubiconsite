@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
  <div class="container">
        <div class="row mt-50">
          @forelse($stories as $value)
          <div class="col-sm-10 col-md-6 col-lg-4 col-xl-4">
            <div class="post-item">
                <div class="post-thumb c-thumb">
                    <a href="{{ route('story.details', [$value->id, str_slug($value->title)]) }}">
                        <img src="{{ getImage('assets/images/stories/thumb_'. $value->image, '385x355')}}" alt="blog">
                    </a>
                </div>
                <div class="post-content">
                    <div class="blog-header">
                        <h6 class="title">
                            <a href="{{ route('story.details', [$value->id, str_slug($value->title)]) }}">{{ Str::words($value->title, 10) }}</a>
                        </h6>
                    </div>
                    <div class="meta-post">
                        <div class="meta-author">
                            <div class="thumb">
                              <a href="{{ route('story.details', [$value->id, str_slug($value->title)]) }}" class="d-block"><img src="{{ getImage('assets/images/user/profile/'. $value->journalist->image, '350x300')}}" alt="image"></a>
                            </div>
                            <h6 class="name"><a href="{{ route('profile', $value->journalist->username) }}">{{ __($value->journalist->username) }}</a></h6>
                        </div>
                        <div class="date">
                            <a href="">
                                {{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}
                            </a>
                        </div>
                    </div>
                    <div class="entry-content">
                        <p>{{ Str::words($value->description, 15) }}</p>
                    </div>
                </div>
            </div>
          </div>
        @empty
            <div class="empty-message-box">
                <div class="icon"><i class="las la-frown"></i></div>
                <p class="caption">@lang('No Story Available')</p>
            </div>
        @endforelse
        </div>
       {{ $stories->links() }}
  </div>
</section>
@endsection


@push('style')
<style>
  .empty-message-box {
      background-color: #fff;
      padding: 100px 50px;
      border: 2px solid #e5e5e5;
      text-align: center;
      width: 100%;
  } 
  .empty-message-box .icon {
      font-size: 120px;
      line-height: 1;
      animation: shake 1s 1 linear;
  } 
  .empty-message-box .caption {
      font-size: 24px;
      font-weight: 500;
      margin-top: 20px;
  } 
  @media(max-width: 767px) {
      .empty-message-box .icon {
      font-size: 90px
      } 
      .empty-message-box .caption {
          font-size: 18px;
      }
  }
</style>
@endpush

