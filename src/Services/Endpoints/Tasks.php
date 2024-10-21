<?php

namespace IsapOu\AgileCrm\Services\Endpoints;

use IsapOu\AgileCrm\Contracts\AgileCrmEndpoint;
use IsapOu\AgileCrm\Dto\TaskDto;

final class Tasks extends \IsapOu\AgileCrm\Services\Endpoints\AgileCrmEndpoint implements AgileCrmEndpoint
{
    protected function getDto(): string
    {
        return TaskDto::class;
    }

    protected function getEndpoint(): string
    {
        return 'tasks';
    }
}
