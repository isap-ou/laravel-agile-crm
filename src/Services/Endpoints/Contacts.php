<?php

namespace Isapp\AgileCrm\Services\Endpoints;

use InvalidArgumentException;
use Isapp\AgileCrm\Contracts\AgileCrmEndpoint;
use Isapp\AgileCrm\Dto\ContactDto;

final class Contacts extends \Isapp\AgileCrm\Services\Endpoints\AgileCrmEndpoint implements AgileCrmEndpoint
{
    protected function getDto(): string
    {
        return ContactDto::class;
    }

    protected function getEndpoint(): string
    {
        return 'contacts';
    }

    public function findByEmail(string $email): ?ContactDto
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email address is invalid');
        }

        $res = $this->request->get($this->getEndpoint() . '/search/email/' . $email);

        $data = $res->json();

        if (empty($data)) {
            return null;
        }

        return $this->getDto()::toDto($data);
    }
}
