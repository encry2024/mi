<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.name') }}</th>
                <td>{{ $model->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.size') }}</th>
                <td>{{ $model->size_quantity }} {{ $model->size->type }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.quantity') }}</th>
                <td>{{ $model->quantity }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.created_at') }}</th>
                <td>{{ date('F d, Y (h:i A)', strtotime($model->created_at)) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.updated_at') }}</th>
                <td>{{ date('F d, Y (h:i A)', strtotime($model->updated_at)) }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->