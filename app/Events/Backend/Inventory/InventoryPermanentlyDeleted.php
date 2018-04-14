<?php

namespace App\Events\Backend\Inventory;

use Illuminate\Queue\SerializesModels;

/**
 * Class InventoryPermanentlyDeleted.
 */
class InventoryPermanentlyDeleted
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
