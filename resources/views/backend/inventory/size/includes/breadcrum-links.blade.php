<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inventory Sizes</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.inventory.item.size.index') }}">Inventory Size List</a>
                <a class="dropdown-item" href="{{ route('admin.inventory.item.size.create') }}">Create New Size</a>
                <a class="dropdown-item" href="{{ route('admin.inventory.item.size.deleted') }}">Deleted Sizes</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>