<?php

namespace BeeDelivery\ifood\Facades;

use Illuminate\Support\Facades\Facade;

class Ifood extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ifood';
    }
}
