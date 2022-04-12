@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-deposit">
                    <div class="card-header bg--6 justify-content-center">
                        <h5 class="text-center text-white">@lang('Current Balance') :
                            <strong>{{ getAmount(auth()->user()->balance)}}  {{ $general->cur_text }}</strong></h5>
                    </div>
                    <div class="card-body mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="withdraw-details">
                                    <span class="font-weight-bold">@lang('Request Amount') :</span>
                                    <span class="font-weight-bold pull-right">{{getAmount($withdraw->amount)  }} {{$general->cur_text }}</span>
                                </div>

                                <div class="withdraw-details text-danger">
                                    <span class="font-weight-bold">@lang('Withdrawal Charge') :</span>
                                    <span class="font-weight-bold pull-right">{{getAmount($withdraw->charge) }} {{$general->cur_text }}</span>
                                </div>

                                <div class="withdraw-details text-info">
                                    <span class="font-weight-bold">@lang('After Charge') :</span>
                                    <span class="font-weight-bold pull-right">{{getAmount($withdraw->after_charge) }} {{$general->cur_text }}</span>
                                </div>


                                <div class="withdraw-details">
                                    <span class="font-weight-bold">@lang('Conversion Rate') : <br>1 {{$general->cur_text }} = </span>
                                    <span class="font-weight-bold pull-right">  {{getAmount($withdraw->rate)  }} {{$withdraw->currency }}</span>
                                </div>

                                <div class="withdraw-details text-success">
                                    <span class="font-weight-bold">@lang('You Will Get') :</span>
                                    <span class="font-weight-bold pull-right">{{getAmount($withdraw->final_amount) }} {{$withdraw->currency }}</span>
                                </div>


                                <div class="form-group mt-5">

                                    <label class="font-weight-bold">@lang('Balance Will be') : </label>
                                    <div class="input-group">
                                        <input type="text" value="{{getAmount($withdraw->user->balance - ($withdraw->amount))}}"  class="form-control form-control-lg" placeholder="@lang('Enter Amount')" required readonly>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text ">{{ $general->cur_text }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <form action="{{route('user.member.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf


                                    @if($withdraw->method->user_data)
                                    @foreach($withdraw->method->user_data as $k => $v)
                                        @if($v->type == "text")
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <input type="text" name="{{$k}}" class="form-control" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == "required") required @endif>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == "textarea")
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3" @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == "file")

                                            <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                         data-trigger="fileinput">
                                                        <img class="w-100" src="{{ getImage(imagePath()['image']['default'])}}" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                    <div class="img-input-div">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new "> @lang('Select') {{$v->field_level}}</span>
                                                                    <span class="fileinput-exists"> @lang('Change')</span>
                                                                    <input type="file" name="{{$k}}" accept="image/*" @if($v->validation == "required") required @endif>
                                                                </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput"> @lang('Remove')</a>
                                                    </div>

                                                </div>
                                                @if ($errors->has($k))
                                                    <br>
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                    @endif

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block cmn-btn mt-4 text-center">@lang('Confirm')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('style-lib')
 <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap-fileinput.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'js/bootstrap-fileinput.js')}}"></script>
@endpush

