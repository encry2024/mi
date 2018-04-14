<?php

namespace App\Events\Backend\Inventory;

use Illuminate\Queue\SerializesModels;

/**
 * Class InventoryDeleted.
 */
class InventoryDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $item;
    public $doer;

    /**
     * @param $item
     */
    public function __construct($doer, $item)
    {
        $this->doer = $doer;
        $this->item = $item;
    }
}
