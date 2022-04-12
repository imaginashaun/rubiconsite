@php
    $content = getContent('journalist.content', true);
    $journalist = \App\User::where('user_type', 'journalist')->where('status', 1)->where('featured', 1)->where('account_status', 1)->select('username', 'address', 'image', 'designation')->get();
@endphp
    <!-- journalist section start -->
    <section class="pt-120 pb-120 section--bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <div class="section-header">
              <h2 class="section-title has--border">{{ __(@$content->data_values->heading) }}</h2>
              <p>{{  __(@$content->data_values->sub_heading) }}</p>
            </div>
          </div>
        </div>
        <div class="row mb-none-30">
        @forelse ($journalist as $key => $value)
            <div class="col-lg-4 mb-30">
              <div class="journalist-card">
                <div class="journalist-card__thumb">
                  <a href="#0" class="d-block">
                    <img src="{{ getImage('assets/images/user/profile/'. $value->image)}}" alt="@lang('image')">
                  </a>
                </div>
                <div class="journalist-card__content">
                  <h6 class="journalist-card__name"><a href="{{ route('profile', $value->username) }}">{{__($value->username) }}</a></h6>
                  <ul class="journalist-card__meta">
                    <li><i class="las la-map-marker"></i> {{__(@$value->address->city)}}, {{__(@$value->address->country)}}</li>
                    <li><i class="las la-id-badge"></i>{{__(@$value->designation)}}</li>
                  </ul>
                  <a href="{{ route('profile', $value->username) }}" class="cmn-btn btn-sm mt-4"> @lang('View Details')</a>
                </div>
              </div>
            </div>
        @empty
        @endforelse
        </div>
      </div>
    </section>
