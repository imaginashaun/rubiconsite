@php
  $content = getContent('client.content', true);
  $clints = getContent('client.element', false);
@endphp
  <!-- client section start -->
  <section class="pt-60 pb-60">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-header text-center">
            <h2 class="section-title">{{ __(@$content->data_values->heading) }}</h2>
            <p>{{ __(@$content->data_values->sub_heading) }}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row">
        <div class="col-lg-12">
          <div class="client-slider">
          @forelse ($clints as $key => $value)
            <div class="single-slide">
              <div class="client-item">
                <img src="{{ getImage('assets/images/frontend/client/'. @$value->data_values->client_image, '260x160')}}" alt="@lang('image')">
              </div>
            </div>
          @empty
            <div class="single-slide">
              <div class="client-item">
                <h6>@lang('No Client')</h6>
              </div>
            </div>
          @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>

