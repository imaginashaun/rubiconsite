@php
    $content = getContent('testimonial.content', true);
    $element = getContent('testimonial.element', false);
@endphp
    <!-- testimonial section start -->
<div class="pt-60 pb-60 section--bg bg_img overlay--one" data-background="{{ getImage('assets/images/frontend/testimonial/'. $content->data_values->background_image, '1920x1445')}}">
    <div class="container-fluid">
      <div class="testimonial-slider">
        @foreach ($element as $key => $value)
          <div class="testimonial-item @if(++$key % 2== 0) even @endif">
              <div class="testimonial-thumb">
                  <a href="#0">
                      <img src="{{ getImage('assets/images/frontend/testimonial/'. $value->data_values->testimonial_image, '300x253')}}" alt="client">
                  </a>
                  <span class="shape"></span>
              </div>
              <div class="testimonial-content">
                  <h5 class="title">
                      <a href="#0">{{__($value->data_values->Name)}}</a>
                  </h5>
                  <span>{{__($value->data_values->designation)}}</span>
                  <p>
                      {{__($value->data_values->testimonial)}}
                  </p>
              </div>
          </div>
          @endforeach
      </div>
    </div>
</div>
