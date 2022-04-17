@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg--6"><h6 class="text-white">{{ __($page_title) }}</h6>
                        <a href="{{route('ticket') }}" class="cmn-btn float-right">
                            @lang('My Support Ticket')
                        </a>
                    </div>

                    <div class="card-body">
                        <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row ">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('Full Name')</label>
                                    <input type="text"  name="name" value="{{@$user->fullname}}" class="form-control form-control-lg" placeholder="@lang('Username')" required readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">@lang('Email address')</label>
                                    <input type="email"  name="email" value="{{@$user->email}}" class="form-control form-control-lg" placeholder="@lang('Enter your Email')" required readonly>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="website">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control form-control-lg" placeholder="@lang('Subject')" >
                                </div>

                                <div class="col-12 form-group">
                                    <label for="inputMessage">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form-control form-control-lg" placeholder="Enter Message">{{old('message')}}</textarea>
                                </div>
                            </div>

                            <div class="row form-group ">
                                <div class="col-sm-9 file-upload">
                                    <label for="inputAttachments">@lang('Attachments')</label>
                                    <input type="file" name="attachments[]" id="inputAttachments" class="form-control mb-2" />
                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted">
                                        @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx")
                                    </p>
                                </div>

                                <div class="col-sm-1">
                                    <button type="button" class="btn bg--5 text-white mt-5 pt-2" onclick="extraTicketAttachment()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row form-group justify-content-center">
                                <div class="col-md-12">
                                    <button class="btn cmn-btn" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
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
        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control my-3" required />')
        }
        function formReset() {
            window.location.href = "{{url()->current()}}"
        }
    </script>
@endpush


@push('style')
    <style>
        .custom-field {
            position: relative;
        }
        .custom-field .form-control ~ label {
            position: absolute;
            top: 0;
            left: 0;
            width: 122px;
            height: 50px;
            background-color: #28DF99;
            color: #fff;
            border-radius: 5px 0 0 5px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush
