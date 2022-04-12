@php
    $content = getContent('hire.content', true);
@endphp
<!-- cta section start -->
<section class="pb-120 pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-wrapper">
                    <div class="thumb bg_img"
                         data-background="{{ getImage('assets/images/frontend/hire/'. $content->data_values->background_image,'1280x853')}}">
                        <a href="{{$content->data_values->video_link}}" data-rel="lightcase:myCollection"
                           class="video-button"><i class="las la-play"></i></a>
                    </div>
                    <div class="content">
                        <h2 class="title mb-3">{{__($content->data_values->heading) }}</h2>
                        <p>{{__($content->data_values->sub_heading) }}</p>
                        <a href="{{ route('journalist') }}" class="cmn-btn mt-4">@lang('Hire Journalist')</a>
                    </div>
                </div><!-- cta-wrapper end -->
            </div>
        </div>
    </div>
</section>
