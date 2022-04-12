@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
 <section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form action="{{ route('user.member.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card profile-setting-top">
                        <div class="card-body d-flex flex-wrap">
                            <div class="left text-center">
                                <div class="profile-thumb mb-4">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url('{{getImage('assets/images/user/profile/' . $user->image)}}');"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" />
                                        <label for="profilePicUpload1" class="col-form-label"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>
                                <h4 class="name">{{__(@$user->fullname)}}</h4>
                                <p class="designation mt-1"><a href="{{@$user->website}}" target="__blank">{{__(@$user->website)}}</a></p>
                                <p>@lang('Member since') : <b>{{showDateTime($user->created_at, 'MM Y')}}</b></p>
                            </div>
                            <div class="right">
                                <div class="row border-bottom">
                                    <div class="col-lg-3 col-sm-6 mb-15">
                                        <h6>@lang('Username') :</h6>
                                        <span>{{__($user->username)}}</span>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 mb-15">
                                        <h6>@lang('Email') :</h6>
                                        <span>{{__($user->email)}}</span>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 mb-15">
                                        <h6>@lang('Phone') :</h6>
                                        <span>{{__($user->mobile)}}</span>
                                    </div>
                                    <div class="col-lg-3 mb-15">
                                        <h6>@lang('Country') :</h6>
                                        <span>{{__(@$user->address->country)}}</span>
                                    </div>
                                </div><!-- row end --> 
                                <div class="row">
                                    <div class="col-lg-12 py-3">
                                        <h6>@lang('Member Description') :</h6>
                                        <p>{{__($user->about_profession)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- card end -->

                <div class="card">
                    <div class="card-header bg--6"><h5 class="text-center text-white">@lang('Profile Update')</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fullname" class="col-form-label">@lang('First Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="firstname"
                                       placeholder="@lang('First Name')" value="{{@$user->firstname}}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lastname" class="col-form-label">@lang('Last Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="@lang('Last Name')" value="{{@$user->lastname}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="website" class="col-form-label">@lang('Member Website') (@lang('Optional'))</label>
                            <input type="text" class="form-control" id="website" name="website"
                               placeholder="@lang('Website')" value="{{@$user->website}}">
                               <small>@lang('https://example.com')</small>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">@lang('Address') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="@lang('Address')" value="{{@$user->address->address}}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="state" class="col-form-label">@lang('State') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="@lang('state')" value="{{@$user->address->state}}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="zip" class="col-form-label">@lang('Zip Code') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="@lang('Zip Code')" value="{{@$user->address->zip}}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label">@lang('City') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="@lang('City')" value="{{@$user->address->city}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">@lang('Member Description') <span class="text-danger">*</span></label>
                            <textarea name="about_profession" id="description" class="form-control" cols="80" placeholder="Member Description">{{@$user->about_profession}}</textarea>
                        </div>

                        <div class="form-group row pt-5">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="cmn-btn btn btn-block">@lang('Update Profile')</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

