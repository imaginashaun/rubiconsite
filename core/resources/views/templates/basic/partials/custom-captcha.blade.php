@if(\App\Extension::where('act', 'custom-captcha')->where('status', 1)->first())
    <div class="form-group col-lg-12">
         @php echo  getCustomCaptcha() @endphp
    </div>


    <div class="form-group col-lg-12">
        <input type="text" name="captcha" placeholder="@lang('Enter Code')" class="form-control" required="">
    </div>

@endif
