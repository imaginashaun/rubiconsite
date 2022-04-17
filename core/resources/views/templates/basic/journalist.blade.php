@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60 section--bg">
<div class="container">
  <div class="row">
    <div class="col-xl-10">
      <form class="journalist-filter-form" action="{{ route('journalist.searchType') }}" method="GET">
        <input type="text" name="search" id="journalist-search-field" value="{{ $searchs ?? ''}}" class="form-control" placeholder="@lang('Search here')">
        <select name="searchType">
          <option value="city">@lang('City')</option>
          <option value="name">@lang('Journalist')</option>
          <option value="country">@lang('Country')</option>
        </select>
        <button class="journalist-search-btn"><i class="las la-search"></i></button>
      </form>
    </div>
  </div>
  <div class="row mb-none-30 mt-50">
    @forelse ($journalist as $key => $journal)
        <div class="col-xl-4 col-sm-6 mb-30">
          <div class="journalist-card">
            <div class="journalist-card__thumb">
              <a href="{{ route('profile', $journal->username) }}" class="d-block">
                <img src="{{ getImage('assets/images/user/profile/'. $journal->image, '350x300')}}" alt="image">
              </a>
            </div>
            <div class="journalist-card__content">
              <h6 class="journalist-card__name"><a href="{{ route('profile', $journal->username) }}">{{ __($journal->username) }}</a></h6>
              <ul class="journalist-card__meta">
                <li><i class="las la-map-marker"></i> {{__(@$journal->address->city)}}, {{__($journal->address->country)}}</li>
                <li><i class="las la-id-badge"></i>{{__(@$journal->designation)}}</li>
              </ul>
              <a href="{{ route('profile', $journal->username) }}" class="cmn-btn btn-sm mt-4">@lang('View Details')</a>
            </div>
          </div>
        </div>
    @empty
      <div class="empty-message-box">
        <div class="icon"><i class="las la-frown"></i></div>
        <p class="caption">@lang('No Journalist Found')</p>
      </div>
    @endforelse
  </div>
   {{ $journalist->links() }}
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
