<?php

Breadcrumbs::register('admin.inventory.item.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.inventories.management'), route('admin.inventory.item.index'));
});

Breadcrumbs::register('admin.inventory.item.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.item.index');
    $breadcrumbs->push(__('labels.backend.inventories.create'), route('admin.inventory.item.create'));
});

Breadcrumbs::register('admin.inventory.item.show', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('admin.inventory.item.index');
    $breadcrumbs->push(__('labels.backend.inventories.view', ['model' => $item->name]), route('admin.inventory.item.show', $item));
});

Breadcrumbs::register('admin.inventory.item.edit', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('admin.inventory.item.index');
    $breadcrumbs->push(__('labels.backend.inventories.edit', ['inventory' => $item->name]), route('admin.inventory.item.edit', $item));
});

Breadcrumbs::register('admin.inventory.item.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.item.index');
    $breadcrumbs->push(__('labels.backend.inventories.deleted'), route('admin.inventory.item.deleted'));
});

Breadcrumbs::register('admin.inventory.item.size.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.item.index');
    $breadcrumbs->push('Item Sizes', route('admin.inventory.item.size.index'));
});