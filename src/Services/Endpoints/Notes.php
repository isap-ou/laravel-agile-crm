<?php

namespace Isapp\AgileCrm\Services\Endpoints;

use Isapp\AgileCrm\Contracts\AgileCrmEndpoint;
use Isapp\AgileCrm\Dto\NoteDto;

final class Notes extends \Isapp\AgileCrm\Services\Endpoints\AgileCrmEndpoint implements AgileCrmEndpoint
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
