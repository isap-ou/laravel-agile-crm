<?php

namespace Isapp\AgileCrm\Facades;

use Illuminate\Support\Facades\Facade;
use Isapp\AgileCrm\Services\AgileCrmClient;

/**
 * @method static AgileCrmClient domain(string $domain)
 * @method static \Isapp\AgileCrm\Services\Endpoints\Contacts contacts()
 * @method static \Isapp\AgileCrm\Services\Endpoints\Tasks tasks()
 * @method static \Isapp\AgileCrm\Services\Endpoints\Notes notes()
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
