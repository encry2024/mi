<?php

namespace App\Events\Backend\Size;

use Illuminate\Queue\SerializesModels;

/**
 * Class SizeCreated.
 */
class SizeCreated
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
