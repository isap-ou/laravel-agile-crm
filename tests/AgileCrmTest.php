<?php

namespace IsapOu\AgileCrm\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use IsapOu\AgileCrm\Contracts\AgileCrmResource;
use IsapOu\AgileCrm\Dto\ContactDto;
use IsapOu\AgileCrm\Dto\ContactPropertyDto;
use IsapOu\AgileCrm\Dto\NoteDto;
use IsapOu\AgileCrm\Enums\ContactPropertySubType;
use IsapOu\AgileCrm\Enums\ContactSystemPropertyName;
use IsapOu\AgileCrm\Facades\AgileCrm;
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
                name: ContactSystemPropertyName::LAST_NAME,
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
