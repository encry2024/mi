@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.inventories.size.management'))

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn" href="{{ route('admin.inventory.item.index') }}">Back to Inventory</a>
        </div><!--dropdown-->
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.size.management') }} <small class="text-muted">{{ __('labels.backend.inventories.size.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.inventory.size.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Size Type</th>
                                    <th>Name</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($sizes))
                                    @foreach ($sizes as $size)
                                        <tr>
                                            <td>{{ $size->type }}</td>
                                            <td>{{ $size->name }}</td>
                                            <td>{{ date('F d, Y (h:i A)', strtotime($size->created_at)) }}</td>
                                            <td>{{ date('F d, Y (h:i A)', strtotime($size->updated_at)) }}</td>
                                            <td>{!! $size->action_buttons !!}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><p class="text-center">There are no available inventory sizes</p></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    <!-- Create Unit Type Modal -->
    <form action="{{ route('admin.inventory.item.size.store') }}" method="POST" class="modal fade in" tabindex="-1" role="dialog" id="create-size-modal">
        {{ csrf_field() }}

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
                                <label for="type" class="col-md-3 form-control-label">Size Type</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="type" name="type" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-3 form-control-label">Name</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" class="modal fade in" tabindex="-1" role="dialog" id="edit-size-modal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Size Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label for="edit-type" class="col-md-3 form-control-label">Size Type</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="edit-type" name="type" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="edit-name" class="col-md-3 form-control-label">name</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="edit-name" name="name" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function getSize(id, type, name) {
            let url = "{{ route('admin.inventory.item.size.update', ':size_id') }}";
                url = url.replace(':size_id', id);

            document.getElementById('edit-type').value = type;
            document.getElementById('edit-name').value = name;

            $("#edit-size-modal").attr('action', url);
        }
    </script>
@endsection
