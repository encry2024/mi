<?php

namespace App\Events\Backend\Size;

use Illuminate\Queue\SerializesModels;

/**
 * Class SizeUpdated.
 */
class SizeUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $size;
    public $doer;

    /**
     * @param $size
     */
    public function __construct($doer, $size)
    {
        $this->doer = $doer;
        $this->size = $size;
    }
}
