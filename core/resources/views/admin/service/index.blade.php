@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('ID')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Short Details')</th>
                                <th scope="col">@lang('Date & Time')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($services as $value)
                            <tr>
                                <td data-label="@lang('id')">{{$loop->iteration}}</td>
                                <td data-label="@lang('Name')">{{ $value->name }}</td>
                                <td data-label="@lang('Short Details')">{{ $value->description }}</td>
                                <td data-label="@lang('Date & Time')">{{ showDateTime($value->created_at) }}</td>
                                <td data-label="@lang('Action')">
                                    <button class="icon-btn btn-primary ml-1 updateBtn" data-id="{{ $value->id }}" data-name="{{ $value->name }}" data-description="{{ $value->description }}" data-toggle="tooltip" data-original-title="Edit"><i class="las la-pencil-alt"></i></button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $services->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>
    </div>


     <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Service')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.service.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" maxlength="191" name="name" value="{{old('name')}}"required placeholder="@lang('Service Name')">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label font-weight-bold">@lang('Short Details')</label>
                            <textarea class="form-control" rows="5" id="description" name="description" placeholder="@lang('Short Details')">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 <div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Service Update')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.service.update')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="data" name="id" value="">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">@lang('Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="191" name="name" value="{{old('name')}}"required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">@lang('Short Details')</label>
                            <textarea class="form-control" rows="5" id="description" name="description">{{old('description')}}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush


@push('script')
    <script>
        (function () {
            'use strict';
            $('.addBtn').on('click', function () {
                var modal = $('#addModal');
                modal.modal('show');
            });

            $('.updateBtn').on('click', function () {
                var modal = $('#updateBtn');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('input[name=name]').val($(this).data('name'));
                modal.find('textarea[name=description]').val($(this).data('description'));
                modal.modal('show');
            });
        })();
    </script>

@endpush
