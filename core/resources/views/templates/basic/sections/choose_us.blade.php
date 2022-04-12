@php
    $content = getContent('choose_us.content', true);
    $element = getContent('choose_us.element', false, 6);
@endphp
    <!-- choose us section start -->
    <section class="pt-120 pb-120 bg_img overlay--one">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <div class="section-header text-white">
              <h2 class="section-title has--border">{{__($content->data_values->heading) }}</h2>
              <p>{{__($content->data_values->sub_heading) }}</p>
            </div>
          </div>
        </div>
        <div class="row mb-none-30">
          @foreach($element as $value)
            <div class="col-lg-4 mb-30">
              <div class="choose-card text-white">
                <div class="choose-card__icon">
                  @php echo $value->data_values->choose_icon  @endphp
                </div>
                <div class="choose-card__content">
                  <h4 class="choose-card__title mb-3">{{__($value->data_values->title) }}</h4>
                  <p>{{__($value->data_values->description) }}</p>
                </div>
              </div><!-- choose-card end -->
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- choose us section end -->
