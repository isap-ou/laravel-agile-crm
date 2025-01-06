<?php

namespace Isapp\AgileCrm\Tests\Feature;

use Illuminate\Support\Collection;
use Isapp\AgileCrm\Dto\ContactDto;
use Isapp\AgileCrm\Dto\ContactPropertyDto;
use Isapp\AgileCrm\Enums\ContactPropertyType;
use Isapp\AgileCrm\Enums\ContactSystemPropertyName;
use Isapp\AgileCrm\Facades\AgileCrm;
use Isapp\AgileCrm\Tests\AgileCrmTest;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;

use function collect;

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
    public function getByEmailNotFound(ContactDto $dto)
    {
        $response = AgileCrm::contacts()->findByEmail($this->faker->email);
        $this->assertNull($response);
    }

    #[Test]
    #[Depends('create')]
    public function getByEmail(ContactDto $dto)
    {
        $emailProperty = collect($dto->properties)
            ->filter(
                function (ContactPropertyDto $propertyDto) {
                    return $propertyDto->type === ContactPropertyType::SYSTEM &&
                        $propertyDto->name->value === ContactSystemPropertyName::EMAIL->value;
                }
            )
            ->first();

        $response = AgileCrm::contacts()->findByEmail($emailProperty->value);
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
