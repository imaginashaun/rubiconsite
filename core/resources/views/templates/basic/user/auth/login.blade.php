@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('login.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')
    <!-- account section start -->
    <section class="pt-60 pb-60">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="account-wrapper">


              <div class="left base--bg" style="background-color: red !important; background-image: url('{{getImage('assets/images/bg_quote.png', '350x300')}}')">

<!--                  <div style="width: 400px; background:rgba(0,0,0,0.71); color: #fff">
                      <p style="color: #fff">"The function of journalism is, primarily, to uncover vital new information in the public interest and to put that information in a context so that we can use it to improve the human condition."</p>
                      <p>-- Joshua Oppenheimer</p>
                  </div>
                  -->



              </div>
              <div class="right">
                  <h4 class="mb-4 col-lg-12">@lang('Login in your account')</h4>
                  <form method="POST" action="{{ route('user.login')}}" onsubmit="return submitUserForm();">
                    @csrf
                    <div class="form-group col-lg-12">
                      <label for="username">@lang('Username')</label>
                      <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="@lang('Enter your username')" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-12">
                      <label>@lang('Password')</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="@lang('Enter Password')" required autocomplete="current-password" required>
                    </div>

                    <div class="form-group">
                        @php echo recaptcha() @endphp
                    </div>

                    @include($activeTemplate.'partials.custom-captcha')

                    <div class="col-lg-12">
                      <button type="submit" class="cmn-btn">@lang('Login Now')</button>
                    </div>

                    <div class="row col-lg-12">
                        <div class="col-lg-6">
                            <a href="{{route('user.password.request')}}" class="mt-4 base--color">@lang('Forgot password?')</a>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                             <a href="{{route('user.register.journalist')}}" class="mt-lg-4 mt-2 base--color">@lang('Registration')</a>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
