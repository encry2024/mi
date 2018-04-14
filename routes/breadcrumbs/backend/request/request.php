<?php

Breadcrumbs::register('admin.request.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Pull-Out List', route('admin.request.index'));
});