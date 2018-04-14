@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.create'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($item, 'PATCH', route('admin.inventory.item.update', $item->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }}
                        <small class="text-muted">{{ __('labels.backend.inventories.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.name'))->class('col-md-2 form-control-label')->for('name ') }}

                        <div class="col-md-10">
                            <input type="text" id="name" name="name" placeholder="{{ __('validation.attributes.backend.inventories.name') }}" class="form-control" value="{{ $item->name }}" required>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.quantity'))->class('col-md-2 form-control-label')->for('inventory') }}

                        <div class="col-md-10">
                            <input type="text" id="quantity" name="quantity" placeholder="{{ __('validation.attributes.backend.inventories.quantity') }}" class="form-control" value="{{ $item->quantity }}">
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-sm-10">
                            <input type="text" id="description" name="description" placeholder="{{ __('validation.attributes.backend.inventories.description') }}" class="form-control" value="{{ $item->description }}">
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.size'))
                        ->class('col-md-2 form-control-label')
                        ->for('size') }}

                        <div class="input-group col-md-10">
                            <input type="text" id="size_quantity" name="size_quantity" placeholder="{{ __('validation.attributes.backend.inventories.size_quantity') }}" class="form-control" value="{{ $item->size_quantity }}">
                            
                            <div class="input-group-prepend">
                                <select name="size_id" id="size-dropdown" class="form-control custom-select">
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ $item->size_id == $size->id ? 'selected' : '' }}>{{ $size->type }} - {{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.price'))->class('col-md-2 form-control-label')->for('inventory') }}

                        <div class="input-group col-md-10">
                            <div class="input-group-prepend input-group-text">PHP</div>
                            <input type="text" id="price" name="price" placeholder="{{ __('validation.attributes.backend.inventories.price') }}" class="form-control" value="{{ $item->price }}">
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.inventory.item.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection