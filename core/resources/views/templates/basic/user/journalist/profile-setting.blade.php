@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form action="{{ route('user.update.profile', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                                <p class="designation mt-1">{{__(@$user->designation)}}</p>
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
                                        <h6>@lang('Skills') :</h6>
                                        <ul class="skill-list mt-2">
                                            @if(!empty($user->skill))
                                                @foreach ($user->skill as  $value)
                                                    <li>{{__($value)}}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="col-lg-12 py-3">
                                        <h6>@lang('Language') :</h6>
                                        <ul class="skill-list mt-2">
                                            @if(!empty($user->language))
                                                @foreach ($user->language as  $value)
                                                    <li>{{__($value)}}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- card end -->
                    <div class="card">
                        <div class="card-header bg--6"><h5 class="text-center text-white">@lang('Profile Update')</h5></div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="service" class="col-form-label">@lang('What is the main service you specialize in?')</label>
                                    <select class="form-control" name="service_id" id="service" required>
                                        <option value="0">@lang('Select Service')</option>
                                        @foreach ($service as $key => $value)
                                            <option value="{{ $value->id }}" @if(old('service_id')== $value->id || $user->service_id == $value->id) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="skill" class="col-form-label">@lang('What are your skills?')</label>
                                        <select name="skill[]" id="skill" class="form-control select2"  multiple="multiple" required>
                                        @if(!empty($user->skill))
                                            @foreach ($user->skill as  $value)
                                                <option value="{{ $value }}" selected="true">{{ $value }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                        <small>@lang('Select at least one skill')</small>
                                    </div>


                                    <div class="form-group col-lg-6">
                                        <label for="language" class="col-form-label">@lang('Language(s)') <span class="text-danger">*</span></label>
                                        <select name="language[]" class="form-control select2Language" id="language" multiple="multiple">
                                            @if(!empty($user->language))
                                                @foreach ($user->language as  $value)
                                                    <option value="{{$value}}" selected="true">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                            @include('partials.languages')
                                    </select>
                                    <small>@lang('Enter at least one Language')</small>
                                    </div>
                                </div>


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
                                    <label for="designation" class="col-form-label">@lang('Designation')</label>
                                    <input type="text" class="form-control" id="designation" name="designation"
                                    placeholder="@lang('Enter Designation')" value="{{@$user->designation}}">
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="address" class="col-form-label">@lang('Address') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="@lang('Address')" value="{{@$user->address->address}}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="state" class="col-form-label">@lang('Province/State/District') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="state" name="state" placeholder="@lang('Province/State/District')" value="{{@$user->address->state}}" required>
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
                                    <label for="description" class="col-form-label">@lang('About yourself') <span class="text-danger">*</span></label>
                                    <textarea name="about_profession" id="description" class="form-control" rows="8" cols="80" placeholder="Member Description">{{@$user->about_profession}}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="cmn-btn btn btn-block">@lang('Update Profile')</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- card end -->
                </form>
            </div>
        </div>
    </div>
  </section>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/select2.min.js') }}"></script>
@endpush

@push('script')
<script>
    'use strict';
    $('.select2').select2({
        tags: true,
        maximumSelectionLength : 15
    });
    $('.select2Language').select2({
        tags: true,
        maximumSelectionLength : 10
    });
    function proPicURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              var preview = $(input).parents('.profile-thumb').find('.profilePicPreview');
              $(preview).css('background-image', 'url(' + e.target.result + ')');
              $(preview).addClass('has-image');
              $(preview).hide();
              $(preview).fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
      }
    }
    $(".profilePicUpload").on('change', function() {
      proPicURL(this);
    });
    $(".remove-image").on('click', function(){
      $(".profilePicPreview").css('background-image', 'none');
      $(".profilePicPreview").removeClass('has-image');
    })
</script>
@endpush




