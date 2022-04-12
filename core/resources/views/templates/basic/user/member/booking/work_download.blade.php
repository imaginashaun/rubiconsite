@extends($activeTemplate.'layouts.member')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
             <div class="card">
              <div class="card-header bg--6 text-white justify-content-center">@lang('Download Work Delivery')</div>
               <div class="card-body">
                 @forelse($work_file_download as $value)
                    <div class="row justify-content-center text-center">
                        <div class="col-md-10 mt-2">
                            <h6 class="mb-2">@lang('Working Delivery Details')</h6>
                            <p>{{$value->details}}</p>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('user.member.work.file.download', $value->id)}}" class="btn bg--5 text-white btn-sm">@lang('Download Work File')</a>
                        </div>
                    </div>
                @empty
                  <h6 class="text-center mt-5">@lang('Work File No Delivery')</h6>
                @endforelse
                </div>
             </div><!-- card end -->
           </div>
         </div>
       </div>
     </section>
@endsection
