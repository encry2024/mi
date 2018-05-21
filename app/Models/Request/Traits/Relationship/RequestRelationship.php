<?php

namespace App\Models\Request\Traits\Relationship;

use App\Models\Inventory\Inventory;
use App\Models\Auth\User;

/**
 * Trait RequestRelationship.
 */
trait RequestRelationship
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class)->withTrashed();
    }
}
