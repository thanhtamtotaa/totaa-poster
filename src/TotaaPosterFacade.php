<?php

namespace Totaa\TotaaPoster;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Totaa\TotaaPoster\Skeleton\SkeletonClass
 */
class TotaaPosterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'totaa-poster';
    }
}
