@extends($activeTemplate.'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
             <div class="card">
               <div class="card-body">
                     <div class="row justify-content-center">
                          <audio controls src="{{ asset('assets/audio/'. $audio_details->audio_file )}}"></audio>
                     </div>
                     <div class="card-title my-4"><b>@lang('Title')</b></div>
                     <h4>{{ __($audio_details->title) }}</h4>
                     <div class="card-title my-4"><b>@lang('Description') </b></div>
                     <div class="card-text">@php echo __($audio_details->descripation) @endphp</div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
