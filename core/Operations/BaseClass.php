<?php

namespace CodeArchitect\Framework\Operations;

use CodeArchitect\Framework\Helper\HelperClass;

class BaseClass
{
    protected HelperClass $helper;

    public function __construct(
        public $mc
    )
    {
        $this->helper = new HelperClass() ;
    }

}