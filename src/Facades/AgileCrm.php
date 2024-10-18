<?php

namespace IsapOu\AgileCrm\Facades;

use Illuminate\Support\Facades\Facade;
use IsapOu\AgileCrm\Services\AgileCrmClient;

/**
 * @method static AgileCrmClient domain(string $domain)
 * @method \IsapOu\AgileCrm\Services\Endpoints\Contacts contacts()
 * @method \IsapOu\AgileCrm\Services\Endpoints\Tasks tasks()
 * @method \IsapOu\AgileCrm\Services\Endpoints\Notes notes()
 */
class AgileCrm extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'AgileCrm';
    }
}
