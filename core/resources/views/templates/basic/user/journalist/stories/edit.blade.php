@extends($activeTemplate .'layouts.journalist')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
				 <div class="card">
						<div class="card-body">
							<form action="{{ route('user.storie.update', $storie->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
								    <label for="category_id">@lang('Category') <span class="text-danger">*</span></label>
								    <select class="form-control" name="category_id" id="category_id">
										<option value="" selected disabled>@lang('Select Category')</option>
											@foreach ($category as $key => $value)
												<option value="{{ $value->id }}" @if($value->id == $storie->category_id) selected @endif>{{ $value->name }}</option>
											@endforeach
									</select>
								 </div>

								<div class="form-group">
				                    <label class="form-control-label font-weight-bold">@lang('Image')</label>
				                    <div class="input-group mb-3">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text" id="inputGroupFileAddon01">@lang('Upload')</span>
				                        </div>
				                        <div class="custom-file">
				                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
				                            <label class="custom-file-label" for="inputGroupFile01">@lang('Choose Image')</label>
				                        </div>
				                    </div>
				                </div>

								<div class="form-group">
								    <label for="title">@lang('Story Title') <span class="text-danger">*</span></label>
								    <input type="text" class="form-control" name="title" maxlength="250" id="title" value="{{$storie->title}}">
								 </div>

								 <div class="form-group">
								    <label for="description">@lang('Story Description') <span class="text-danger">*</span></label>
								    <textarea rows="4" class="form-control" name="description" id="description" maxlength="5000" placeholder="Enter Description">{{$storie->description}}</textarea>
								 </div>
									

								<button type="submit" class="cmn-btn btn-block">@lang('Story Update')</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@push('script')
  <script>
    'use strict';
     (function($){
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
      })(jQuery)
  </script>
@endpush