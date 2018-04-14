<?php

namespace App\Models\Inventory\Traits\Relationship;

use App\Models\Inventory\Size;
use App\Models\Request\Request as ItemRequest;

/**
 * Trait InventoryRelationship.
 */
trait InventoryRelationship
{
    /**
     * @return mixed
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * @return mixed
     */
    public function item_requests()
    {
        return $this->belongsTo(ItemRequest::class);
    }
}
