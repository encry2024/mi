@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.create'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.inventory.item.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }}
                        <small class="text-muted">{{ __('labels.backend.inventories.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.name'))->class('col-md-2 form-control-label')->for('name ') }}

                        <div class="col-md-10">
                            {{
                                html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.inventories.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.quantity'))->class('col-md-2 form-control-label')->for('inventory') }}

                        <div class="col-md-10">
                            {{
                                html()->text('quantity')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.inventories.quantity'))
                                ->attribute('maxlength', 191)
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-sm-10">
                            {{
                                html()->text('description')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.inventories.description'))
                                ->attribute('maxlength', 191)
                            }}
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.size'))
                        ->class('col-md-2 form-control-label')
                        ->for('size') }}

                        <div class="input-group col-md-10">
                            {{
                                html()->text('size_quantity')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.inventories.size_quantity'))
                                ->attribute('maxlength', 191)
                            }}
                            <div class="input-group-prepend">
                                <select name="size_id" id="size-dropdown" class="form-control custom-select">
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->type }} - {{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventories.price'))->class('col-md-2 form-control-label')->for('inventory') }}

                        <div class="input-group col-md-10">
                            <div class="input-group-prepend input-group-text">PHP</div>
                            <input type="text" id="price" name="price" placeholder="{{ __('validation.attributes.backend.inventories.price') }}" class="form-control">
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
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection