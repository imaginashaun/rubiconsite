@php
    $content = getContent('how_it_work.content', true);
    $element = getContent('how_it_work.element', false, 3);
    $element_journalist = getContent('how_it_work_journalist.element', false, 3);
@endphp
    <section class="pt-120 pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <div class="section-header">
              <h2 class="section-title has--border">{{ __($content->data_values->heading) }}</h2>
              <p>{{ __($content->data_values->sub_heading) }}</p>
            </div>
          </div>
        </div>
        <ul class="nav nav-tabs p-0 border-0 justify-content-center how-it-works-menu">
          <li>
            <a class="active" href="#member" data-toggle="tab">@lang('Members')</a>
          </li>
          <li>
            <a href="#journalist" data-toggle="tab">@lang('Journalist')</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane show fade active" id="member">
            <div class="row mb-none-30">
              @forelse ($element as $key => $value)
                  <div class="col-lg-4 mb-30">
                    <div class="work-card">
                      <div class="work-card__icon">
                      @php echo $value->data_values->work_icon @endphp
                        <span class="step-number text-white">{{ ++$key }}</span>
                      </div>
                      <div class="work-card__content">
                        <h5 class="title mb-3">{{ __($value->data_values->title) }}</h5>
                        <p>{{ __($value->data_values->description) }}</p>
                      </div>
                    </div>
                  </div>
              @empty

              @endforelse
            </div>
          </div>
          <div class="tab-pane fade" id="journalist">
            <div class="row mb-none-30">
              @forelse ($element_journalist as $key => $value)
                  <div class="col-lg-4 mb-30">
                    <div class="work-card">
                      <div class="work-card__icon">
                      @php echo $value->data_values->work_icon @endphp
                        <span class="step-number text-white">{{ ++$key }}</span>
                      </div>
                      <div class="work-card__content">
                        <h5 class="title mb-3">{{ __($value->data_values->title) }}</h5>
                        <p>{{ __($value->data_values->description) }}</p>
                      </div>
                    </div>
                  </div>
              @empty

              @endforelse
            </div>
          </div>
        </div>
      </div>
    </section>
