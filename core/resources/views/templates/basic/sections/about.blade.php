@php
    $content = getContent('about.content', true);
@endphp
    <section class="pt-60 pb-60">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 pr-lg-5">
            <div class="about-thumb">
              <img src="{{ getImage('assets/images/frontend/about/'. @$content->data_values->about_image,'1280x853')}}" alt="image">
              <div class="content bg--base text-center text-white">
                <h4 class="year">{{__(@$content->data_values->image_number)}}</h4>
                <span class="caption">{{__(@$content->data_values->text)}}</span>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-content">
              <h2 class="section-title">{{__(@$content->data_values->heading)}}</h2>
                  <div>@php echo @$content->data_values->description @endphp </div>
            </div>
          </div>
        </div>
      </div>
    </section>

