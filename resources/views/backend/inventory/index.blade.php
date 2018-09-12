@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.inventories.management'))

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
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.inventory.includes.header-buttons')
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
                            <th>{{ __('labels.backend.inventories.table.quantity') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($inventories))
                                @foreach ($inventories as $item)
                                    <tr>
                                        @if ($item->trashed())
                                        <td>{{ ucfirst($item->name) }} (DELETED)</td>
                                        @else
                                        <td>{{ ucfirst($item->name) }}</td>
                                        @endif
                                        <td>{{ ucfirst($item->description) }}</td>
                                        <td>{{ $item->quantity }} pc(s)</td>
                                        <td>{!! $item->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><p class="text-center">There are no stored items in the inventory</p></td>
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

<form method="POST" class="modal fade in" tabindex="-1" role="dialog" id="request-item-modal">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Size Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label">Item Name</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" id="name" name="name" required disabled>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="size" class="col-md-4 form-control-label">Remaining Qty.</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" id="size" name="size" required disabled>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="request_stock" class="col-md-4 form-control-label">Requested Stocks</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" id="request_stock" name="request_stock" required maxlength="20">
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="requested_by" class="col-md-4 form-control-label">Requested By</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" id="requested_by" name="requested_by" required>
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Request</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</form>

<script>
    function requestItem(id, size, name) {
        let url = "{{ route('admin.inventory.item.request', ':item') }}";
            url = url.replace(':item', id);

        document.getElementById('size').value = size;
        document.getElementById('name').value = name;

        $("#request-item-modal").attr('action', url);
    }
</script>
@endsection
