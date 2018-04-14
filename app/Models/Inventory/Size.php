<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inventory\Traits\Attribute\SizeAttribute;

class Size extends Model
{
    //
    use SoftDeletes, SizeAttribute;

    protected $fillable = ['type', 'name'];
}
