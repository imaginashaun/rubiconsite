@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('hero.content', true);
@endphp

<style>

    .hero::before {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000000;
        opacity: 0.45;
    }

    .hero {
        padding-top: 250px;
        padding-bottom: 111px;
        position: relative;
        z-index: 1;
    }

    </style>
	<section class="hero bg_img background-position-y-top" data-background="{{ getImage('assets/images/frontend/hero/'. $content->data_values->hero_background_image, '1280x853')}}">
	  <div class="container">
	    <div class="row justify-content-center">
	      <div class="col-lg-6 text-center">
	        <h2 class="hero__title text-white">{{ __($content->data_values->heading) }}</h2>
	       <!-- <form action="{{ route('search') }}" method="GET" class="hero__search">
	          <input type="text" name="search" id="hero-search-field" placeholder="Search with name or city or country " class="form-control">
	          <button type="submit" class="search-btn"><i class="la la-search"></i>@lang('Search')</button>
	        </form>-->
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
