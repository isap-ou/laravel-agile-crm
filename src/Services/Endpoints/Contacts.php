<?php

namespace IsapOu\AgileCrm\Services\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use IsapOu\AgileCrm\Contracts\AgileCrmEndpoint;
use IsapOu\AgileCrm\Contracts\AgileCrmResource;
use IsapOu\AgileCrm\Contracts\DtoContract;
use IsapOu\AgileCrm\Dto\ContactDto;

final class Contacts extends \IsapOu\AgileCrm\Services\Endpoints\AgileCrmEndpoint implements AgileCrmEndpoint
{
    protected function getDto(): string
    {
        return ContactDto::class;
    }

    protected function getEndpoint(): string
    {
        return 'contacts';
    }
}
