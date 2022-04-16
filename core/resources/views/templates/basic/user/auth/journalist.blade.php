@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('journalist_register.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')
<!-- account section start -->
<section class="pt-120 pb-120">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="account-wrapper">
            <div class="left base--bg" style="background-image: url('{{getImage('assets/images/bg_quote.png', '350x300')}}')">
             <!-- <div style="width: 400px; background:rgba(0,0,0,0.71); color: #fff">
                  <p style="color: #fff">"The function of journalism is, primarily, to uncover vital new information in the public interest and to put that information in a context so that we can use it to improve the human condition."</p>
                  <p>-- Joshua Oppenheimer</p>
              </div>-->
          </div>
          <div class="right">
            <div>
              <h4 class="mb-4">@lang('Create an account')</h4>
              <form action="{{ route('user.register') }}" method="POST" onsubmit="return submitUserForm();">
                @csrf
                <input type="hidden" name="user_type" value="journalist">
              <div class="form-row">
                <div class="form-group col-lg-6">
                  <label for="firstname">@lang('First Name')</label>
                  <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="@lang('First Name')" class="form-control" required>
                </div>

                <div class="form-group col-lg-6">
                  <label for="lastname">@lang('Last Name')</label>
                  <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="@lang('Last Name')" class="form-control" required>
                </div>

                <div class="form-group col-lg-6">
                  <label for="username">@lang('Username')</label>
                  <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="@lang('Username')" class="form-control">
                </div>

                <div class="form-group col-lg-6">
                    <label for="email">@lang('Email Address')</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="@lang('Email Address')" class="form-control">
                </div>


                <div class="form-group col-lg-6 country-code">
                    <label for="mobile">@lang('Mobile')</label>
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text p-0">
                                <select name="country_code">
                                    @include('partials.country_code')
                                </select>
                            </span>
                        </div>
                        <input type="text" name="mobile" class="form-control" placeholder="@lang('Your Phone Number')">
                    </div>
                </div>



                <div class="form-group col-lg-6">
                    <label for="email">@lang('Country')</label>
                    <input type="text" name="country" class="form-control" readonly>
                </div>

                <div class="form-group col-lg-6">
                  <label for="password">@lang('Password')</label>
                  <input type="password" id="password" name="password" placeholder="@lang('Password')" class="form-control">
                </div>
                <div class="form-group col-lg-6">
                  <label for="password_confirm">@lang('Confirm Password')</label>
                  <input type="password" id="password_confirm" name="password_confirmation" placeholder="@lang('Confirm Password')" class="form-control">
                </div>

                <div class="form-group">
                    @php echo recaptcha() @endphp
                </div>

                @include($activeTemplate.'partials.custom-captcha')
                <div class="col-lg-6 mt-3">
                    <button type="submit" class="cmn-btn">@lang('Sign Up')</button>
                </div>
                <div class="col-lg-6 text-lg-right">
                  <p>@lang('Have an account?') <a href="{{route('user.login')}}" class="mt-4 base--color">@lang('Login')</a></p>
                </div>
               </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('style')
<style type="text/css">
    .country-code .input-group-prepend .input-group-text{
        background: #fff !important;
    }
    .country-code select{
        border: none;
        height: 40px;
        font-size: 14px;
        padding: 6px;
    }
    .country-code select:focus{
        border: none;
        outline: none;
    }
</style>
@endpush
@push('script')
    <script>
      "use strict";
      @if($country_code)
        var t = $(`option[data-code={{ $country_code }}]`).attr('selected','');
      @endif
        $('select[name=country_code]').change(function(){
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();
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
