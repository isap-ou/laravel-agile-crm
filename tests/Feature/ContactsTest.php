<?php

namespace IsapOu\AgileCrm\Tests\Feature;

use Illuminate\Support\Collection;
use IsapOu\AgileCrm\Dto\ContactDto;
use IsapOu\AgileCrm\Facades\AgileCrm;
use IsapOu\AgileCrm\Tests\AgileCrmTest;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;

class ContactsTest extends AgileCrmTest
{
    #[Test]
    public function index(): void
    {
        $response = AgileCrm::contacts()->index();

        $this->assertInstanceOf(Collection::class, $response);
    }

    #[Test]
    public function create(): ContactDto
    {
        $response = $this->createContact();

        $this->assertInstanceOf(ContactDto::class, $response);

        return $response;
    }

    #[Test]
    #[Depends('create')]
    public function show(ContactDto $dto): void
    {
        $response = AgileCrm::contacts()->show($dto->id);

        $this->assertInstanceOf(ContactDto::class, $response);
    }

    #[Test]
    #[Depends('create')]
    public function test_delete(ContactDto $dto): void
    {
        $response = AgileCrm::contacts()->delete($dto->id);

        $this->assertTrue($response);
    }
}
