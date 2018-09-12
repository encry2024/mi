<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inventory\Traits\Attribute\InventoryAttribute;
use App\Models\Inventory\Traits\Relationship\InventoryRelationship;

class Inventory extends Model
{
    //
    use SoftDeletes,
        InventoryAttribute,
        InventoryRelationship;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'size_quantity',
        'price'
    ];
}
