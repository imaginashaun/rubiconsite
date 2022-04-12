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
                         <div class="col-lg-6">
                             <iframe width="100%" height="220" src="{{ $video_details->video_file }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                         </div>
                       </div>
                       <div class="card-title my-4"><b>@lang('Title')</b></div>
                       <h4>{{ __($video_details->title) }}</h4>
                       <div class="card-title my-4"><b>@lang('Description') </b></div>
                       <div class="card-text">@php echo __($video_details->descripation) @endphp</div>
                  </div>
               </div><!-- card end -->
            </div>
        </div><!-- row end -->
    </div>
</section>
@endsection

