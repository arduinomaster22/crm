<?php

namespace Backstage\Crm\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Backstage\Crm\Crm
 */
class Crm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Backstage\Crm\Crm::class;
    }
}
