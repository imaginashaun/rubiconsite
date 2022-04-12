@php
    $content = getContent('contact_us.content', true);
@endphp
<div class="header-top">
        <div class="container">
            <div class="d-flex flex-wrap mx--5 justify-content-sm-between justify-content-center align-items-center">

                <div class="col-8 d-flex flex-wrap">
                  <div class="header-top-item">
                      <a href="Mailto:{{$content->data_values->email_address}}"><i class="las la-envelope-open"></i> {{__($content->data_values->email_address) }}</a>
                  </div>
                  <div class="header-top-item mr-auto">
                      <a href="Tel:{{$content->data_values->contact_number}}"><i class="las la-phone"></i> {{__($content->data_values->contact_number) }}</a>
                  </div>
                </div>

                <div class="col-4">
                  <div class="header-language text-right">
                    <select class="w-auto langSel">
                      @foreach($language as $item)
                        <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </div>
        </div>
    </div>