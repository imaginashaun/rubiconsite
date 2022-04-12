@extends($activeTemplate .'layouts.frontend')
@section('content')
@php
    $content = getContent('breadcrumb.content', true);
@endphp

@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120 section--bg">
  <div class="container">
    <div class="card">
        <div class="card-body p-0">
            <div class="d-flex flex-wrap-reverse">
                <div class="col-md-6 p-0 overlay--two bg_img py-5 px-3 d-flex flex-wrap justify-content-center align-items-center" data-background="{{ getImage('assets/images/frontend/breadcrumb/'. @$content->data_values->image)}}">
                    <a href="{{ route('user.login') }}" class="cmn-btn btn-sm-sm">@lang('Oh, I remember the password.')</a>
                </div>
                <div class="col-md-6 px-3 px-sm-4 py-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="cmn-btn btn-sm-sm">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
