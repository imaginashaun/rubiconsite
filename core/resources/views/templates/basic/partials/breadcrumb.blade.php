@php
    $content = getContent('breadcrumb.content', true);
@endphp
    <!-- inner hero start -->


<style>

    .inner-hero {
        padding-top: 100px;
        padding-bottom: 20px;
    }

    </style>
    <section class="inner-hero bg_img background-position-y-top" data-background="{{ getImage('assets/images/frontend/breadcrumb/'. @$content->data_values->image)}}">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h2 class="inner-hero__title text-white">{{__($page_title)}}</h2>
            <ul class="page-breadcrumb justify-content-center">
              <li><a href="{{route('home')}}">@lang('Home')</a> - {{__($page_title)}}</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- inner hero end -->

<div class="modal fade" id="expressionOfInterest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Expression of Interest')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.journalist.booking.approved.express') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input type="hidden" name="order_number">

                        <label for="status" class="form-control-label font-weight-bold">@lang('Expression of Interest') <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" name="descripation" placeholder="@lang('Hi, I am interested in doing this story...')">{{ old('descripation') }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg--1 text-white" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn bg--5 text-white">@lang('Submit')</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>



