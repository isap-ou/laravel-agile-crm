<?php

namespace Isapp\AgileCrm\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Isapp\AgileCrm\Contracts\AgileCrmResource;
use Isapp\AgileCrm\Dto\ContactDto;
use Isapp\AgileCrm\Dto\ContactPropertyDto;
use Isapp\AgileCrm\Dto\NoteDto;
use Isapp\AgileCrm\Enums\ContactPropertySubType;
use Isapp\AgileCrm\Enums\ContactSystemPropertyName;
use Isapp\AgileCrm\Facades\AgileCrm;
use Tests\TestCase as BaseTestCase;

abstract class AgileCrmTest extends BaseTestCase
{
    use WithFaker;

    protected function createContact(): ?AgileCrmResource
    {
        $dto = new ContactDto(properties: [
            new ContactPropertyDto(
                name: ContactSystemPropertyName::FIRST_NAME,
                value: $this->faker->firstName,
            ),
            new ContactPropertyDto(
                name: ContactSystemPropertyName::LAST_NAME,
                value: $this->faker->lastName,
            ),
            new ContactPropertyDto(
                name: ContactSystemPropertyName::EMAIL,
                value: $this->faker->email,
                subtype: ContactPropertySubType::PERSONAL,
            ),
        ]);

        return AgileCrm::contacts()->create($dto);
    }

    protected function createNote(ContactDto $contactDto): AgileCrmResource
    {
        $dto = new NoteDto(
            subject: $this->faker->text(64),
            description: $this->faker->text(256),
            contact_ids: [(string) $contactDto->id]
        );

        return AgileCrm::notes()->create($dto);
    }
}
