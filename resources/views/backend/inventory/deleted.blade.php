@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.deleted'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }}
                        <small class="text-muted">{{ __('labels.backend.inventories.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                        <tr>
                            <th>{{ __('labels.backend.inventories.table.name') }}</th>
                            <th>{{ __('labels.backend.inventories.table.description') }}</th>
                            <th>{{ __('labels.backend.inventories.table.size') }}</th>
                            <th>{{ __('labels.backend.inventories.table.quantity') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($inventories))
                                @foreach ($inventories as $item)
                                    <tr>
                                        <td>{{ ucfirst($item->name) }}</td>
                                        <td>{{ ucfirst($item->description) }}</td>
                                        @if ($item->size->trashed())
                                        <td>{{ $item->size_quantity }} N/A</td>
                                        @else
                                        <td>{{ $item->size_quantity }} {{ $item->size->name }}</td>
                                        @endif
                                        <td>{{ ucfirst($item->quantity) }}</td>
                                        <td>{!! $item->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><p class="text-center">There are no deleted items in the inventory</p></td>
                                </tr>
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $inventories->total() !!} {{ trans_choice('labels.backend.inventories.table.total', $inventories->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $inventories->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
