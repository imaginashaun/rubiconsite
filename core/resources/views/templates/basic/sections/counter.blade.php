@php
    $elements = getContent('counter.element', false);
@endphp
<div class="pb-120">
    <div class="container">
        <div class="row py-5 px-4 overlay--one border-radius--10 overflow-hidden bg_img bg-white shadow">
        @forelse($elements as $value)
          <div class="col-lg-3">
            <div class="counter-item text-white">
                <div class="counter-item__icon">
                    @php echo $value->data_values->icon @endphp
              </div>
              <div class="counter-item__content">
                <h4 class="title">{{__($value->data_values->digits)}}</h4>
                <p class="caption">{{__($value->data_values->title)}}</p>
              </div>
            </div>
          </div>
        @empty
        @endforelse
      </div>
    </div>
  </div>
