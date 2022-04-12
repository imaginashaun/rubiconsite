@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.member.password.update') }}" method="post" class="register">
                            @csrf
                            <div class="form-group">
                                <label for="password">{{ __(trans('Current password'))}}</label>
                                <input id="password" type="password" class="form-control" name="current_password" placeholder="@lang('Enter Current Password')" required
                                       autocomplete="current-password">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __(trans('New Password'))}}</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="@lang('Enter New Password')" required
                                       autocomplete="current-password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">{{ __(trans('Confirm Password'))}}</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                       name="password_confirmation" placeholder="@lang('Enter Confirm Password')" required autocomplete="current-password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cmn-btn">@lang('Password Update')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>             
@endsection
