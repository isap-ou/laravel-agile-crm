<?php

namespace IsapOu\AgileCrm\Services\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use IsapOu\AgileCrm\Contracts\AgileCrmResource;
use IsapOu\AgileCrm\Contracts\DtoContract;

use function collect;

abstract class AgileCrmEndpoint implements \IsapOu\AgileCrm\Contracts\AgileCrmEndpoint
{
    abstract protected function getDto(): string;

    abstract protected function getEndpoint(): string;

    public function __construct(
        protected PendingRequest $request
    ) {}

    /**
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function index(array $query = []): Collection
    {
        $response = $this->request->get($this->getEndpoint(), $query);

        if ($response->failed()) {
            throw $response->throw();
        }

        $data = $response->json() ?? [];

        return collect($data)->map(fn ($item) => $this->getDto()::toDto($item));
    }

    public function show(int|string $id): AgileCrmResource
    {
        $res = $this->request->get($this->getEndpoint() . '/' . $id);

        $data = $res->json();

        return $this->getDto()::toDto($data);
    }

    /**
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function create(DtoContract $dto): ?AgileCrmResource
    {
        $array = $dto->toArray();

        $res = $this->request->post($this->getEndpoint(), $array);

        $data = $res->json();

        return $this->getDto()::toDto($data);
    }

    /**
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function delete(int|string $id): bool
    {
        $response = $this->request->delete($this->getEndpoint() . '/' . $id);

        if ($response->failed()) {
            throw $response->throw();
        }

        return $response->status() < 400;
    }
}
