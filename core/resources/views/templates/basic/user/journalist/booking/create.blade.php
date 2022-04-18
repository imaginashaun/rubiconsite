@extends($activeTemplate .'layouts.journalist')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')



    <section class="pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('user/journalist/booking/store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-lg-12">
                                    <label for="title">@lang('Title')</label>

                                            <input type="text" name="title" id="title" placeholder="@lang('Title')" value="{{ old('budget') }}" class="form-control" required="">

                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="delivery_date">@lang('Delivery Date')</label>
                                    <input type="text" name="delivery_date" id="delivery_date" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" data-position='bottom left' value="{{ date('Y-m-d') }}" placeholder="@lang('Select Date')" autocomplete="off" required="">
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label for="budget" class="ml-3">@lang('What Budget do you accept')</label>
                                    <div class="col-auto">
                                        <label class="sr-only" for="inlineFormInputGroup">@lang('Username')</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                            </div>
                                            <input type="text" name="budget" id="budget" placeholder="@lang('Amount')" value="{{ old('budget') }}" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-12 form-group">
                                    <label for="service_id">@lang('Service Type')</label>
                                    <select id="service_id" name="service_id" required>
                                        <option value="">--Select--</option>

                                        <?php
                                        for($i=0;$i<count($services);$i++){
                                        echo "<option value=".$services[$i]->id.">".$services[$i]->name."</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="description">@lang('Description')</label>
                                    <textarea placeholder="@lang('Description')" name="description" id="description" class="form-control" required="">{{ old('description')}}</textarea>
                                </div>
                                <button type="submit" class="cmn-btn btn-block">@lang('Submit')</button>
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
        'use strict';
        (function($){
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        })(jQuery)
    </script>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/datepicker.min.css') }}">
@endpush
@push('script-lib')
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        'use strict';
        (function($){
            $('.datepicker-here').datepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                minDate: new Date(),
                autoClose: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
        })(jQuery)
    </script>
@endpush
