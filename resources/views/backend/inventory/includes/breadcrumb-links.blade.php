<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.inventories.item.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.inventory.item.index') }}">{{ __('menus.backend.inventories.item.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.inventory.item.create') }}">{{ __('menus.backend.inventories.item.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.inventory.item.deleted') }}">{{ __('menus.backend.inventories.item.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>