@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h6>{{ __($page_title) }}</h6>
                </div>
                <div class="card-body">
                  <form action="" method="post" class="register">
                      @csrf
                      <div class="form-group">
                          <label for="password">{{ __(trans('Current Password')) }}</label>
                          <input id="password" type="password" class="form-control" name="current_password" placeholder="@lang('Enter Current Password')" required autocomplete="current-password">
                      </div>

                      <div class="form-group">
                          <label for="password">{{ __(trans('New Password'))}}</label>
                          <input id="password" type="password" class="form-control" name="password" placeholder="@lang('Enter New Password')" required
                                 autocomplete="current-password">
                      </div>

                      <div class="form-group">
                          <label for="confirm_password">{{ __(trans('Confirm Password'))}}</label>
                          <input id="password_confirmation" type="password" class="form-control"
                                 name="password_confirmation" placeholder="@lang('Confirm Password')" required autocomplete="current-password">
                      </div>

                      <button type="submit" class="cmn-btn" value="{{trans('Change Password')}}">@lang('Password Update')</button>
                  </form>
                </div>
              </div>
          </div>
        </div>
    </div>
  </section>

@endsection
