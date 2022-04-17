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
                          <img src="{{ asset('assets/images/stories/'. $storie->image) }}" width="30%" alt="" class="img-rounded center-block">
                     </div>
                     <h6 class="pt-2">@lang('Category')</h6>
                     <div class="card-text my-3">{{ __($storie->category->name) }}</div>
                     <h6 class="pt-2">@lang('Title')</h6>
                     <div class="card-text my-3">{{ __($storie->title) }}</div>
                     <h6>@lang('Description')</h6>
                     <div class="card-text my-3">@php echo $storie->description @endphp</div>
                </div>
             </div>
          </div>
      </div>
    </div>
  </section>
@endsection
