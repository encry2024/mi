<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Request\Traits\Relationship\RequestRelationship;

class Request extends Model
{
    //
    use RequestRelationship;

    protected $fillable = [
        'quantity',
        'user_id',
        'date_requested',
        'inventory_id',
        'requested_by'
    ];
}
