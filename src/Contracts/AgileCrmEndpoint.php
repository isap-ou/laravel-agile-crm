<?php

namespace IsapOu\AgileCrm\Contracts;

use Illuminate\Support\Collection;

interface AgileCrmEndpoint
{
    public function index(array $query = []): Collection;

    public function show(int|string $id): ?AgileCrmResource;

    public function create(DtoContract $dto): ?AgileCrmResource;

    public function delete(int|string $id): bool;
}
