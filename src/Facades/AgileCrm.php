<?php

namespace IsapOu\AgileCrm\Facades;

use Illuminate\Support\Facades\Facade;
use IsapOu\AgileCrm\Services\AgileCrmClient;

/**
 * @method static AgileCrmClient domain(string $domain)
 * @method static \IsapOu\AgileCrm\Services\Endpoints\Contacts contacts()
 * @method static \IsapOu\AgileCrm\Services\Endpoints\Tasks tasks()
 * @method static \IsapOu\AgileCrm\Services\Endpoints\Notes notes()
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
