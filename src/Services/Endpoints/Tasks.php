<?php

namespace Isapp\AgileCrm\Services\Endpoints;

use Isapp\AgileCrm\Contracts\AgileCrmEndpoint;
use Isapp\AgileCrm\Dto\TaskDto;

final class Tasks extends \Isapp\AgileCrm\Services\Endpoints\AgileCrmEndpoint implements AgileCrmEndpoint
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
