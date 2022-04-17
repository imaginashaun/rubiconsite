@extends($activeTemplate .'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
  <section class="pt-60 pb-60">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mt-5">
            @php echo $data->data_values->description @endphp
        </div>
      </div>
    </div>
  </section>
@endsection

