@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
 <section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="account-wrapper">
                <div class="left base--bg">
                    <div>
                        <h2 class="text-white mb-4">{{__($page_title)}}</h2>
                    </div>
                </div>
                <div class="right">
                    <div>
                        <h4 class="mb-4">@lang('Reset Password')</h4>
                        <form method="POST" action="{{ route('user.password.update') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">


                            <div class="form-group">
                                <label for="password">@lang('Password')</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">@lang('Confirm Password')</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>

                            <div>
                                <button type="submit" class="cmn-btn">@lang('Login Now')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- account-wrapper end -->
        </div>
    </div>
</div>
</section>
@endsection
