@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('hero.content', true);
@endphp
	<section class="hero bg_img background-position-y-top" data-background="{{ getImage('assets/images/frontend/hero/'. $content->data_values->hero_background_image, '1280x853')}}">
	  <div class="container">
	    <div class="row justify-content-center">
	      <div class="col-lg-6 text-center">
	        <h2 class="hero__title text-white">{{ __($content->data_values->heading) }}</h2>
	        <form action="{{ route('search') }}" method="GET" class="hero__search">
	          <input type="text" name="search" id="hero-search-field" placeholder="Search with name or city or country " class="form-control">
	          <button type="submit" class="search-btn"><i class="la la-search"></i>@lang('Search')</button>
	        </form>
	        <p class="hero__info-text"><i class="las la-info-circle"></i> {{ __($content->data_values->sub_heading) }}</p>
	      </div>
	    </div>
	  </div>
	</section>
    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
