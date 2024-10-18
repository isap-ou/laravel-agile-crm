<?php

namespace IsapOu\AgileCrm\Services\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use IsapOu\AgileCrm\Contracts\AgileCrmEndpoint;
use IsapOu\AgileCrm\Contracts\AgileCrmResource;
use IsapOu\AgileCrm\Contracts\DtoContract;
use IsapOu\AgileCrm\Dto\NoteDto;
use IsapOu\AgileCrm\Dto\TaskDto;

final class Notes extends \IsapOu\AgileCrm\Services\Endpoints\AgileCrmEndpoint implements AgileCrmEndpoint
{
    protected function getDto(): string
    {
        return NoteDto::class;
    }

    protected function getEndpoint(): string
    {
        return 'notes';
    }
}
