@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
             <div class="card">
               <div class="card-body">
                     <div class="row justify-content-center">
                          <img src="{{ asset('assets/images/workFile/'. $image_details->image) }}" width="30%" alt="" class="img-rounded center-block">
                     </div>
                     <div class="card-title my-4"><b>@lang('Title')</b></div>
                     <h4>{{$image_details->title}}</h4>
                     <div class="card-title my-4"><b>@lang('Description')</b></div>
                     <div class="card-text">@php echo __($image_details->descripation) @endphp</div>
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
        $(".addVideoBtn").on('click', function(){
             var modal = $('#addModal');
             modal.modal('show');
        });
      })(jQuery)
  </script>
@endpush
