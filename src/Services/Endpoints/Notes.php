<?php

namespace IsapOu\AgileCrm\Services\Endpoints;

use IsapOu\AgileCrm\Contracts\AgileCrmEndpoint;
use IsapOu\AgileCrm\Dto\NoteDto;

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
