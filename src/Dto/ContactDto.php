<?php

namespace Isapp\AgileCrm\Dto;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Isapp\AgileCrm\Enums\ContactPropertySubType;
use Isapp\AgileCrm\Enums\ContactPropertyType;
use Isapp\AgileCrm\Enums\ContactSystemPropertyName;
use RuntimeException;

final class ContactDto extends Dto
{
    public string $type = 'PERSON';

    public array $campaignStatus = [];

    public array $unsubscribeStatus = [];

    public array $emailBounceStatus = [];

    public ?int $star_value = 0;

    public array $properties = [];

    public ?DateTimeInterface $created_time = null;

    public function __construct(
        public ?int $id = null,
        /** @var string[] $tags */ public array $tags = [],
        /** @var ContactPropertyDto[] $properties */ array $properties = [],
        public int $lead_score = 0,
        public ?int $contact_company_id = null,
        ?int $star_value = 0,
    ) {
        if ($star_value < 0 || $star_value > 5) {
            throw new RuntimeException('$star_value must be between 0 and 5');
        }

        $this->star_value = $star_value;

        if (! empty($properties)) {
            foreach ($properties as $property) {
                if (! ($property instanceof ContactPropertyDto)) {
                    throw new RuntimeException('Properties must be instance of ContactPropertyDto');
                }
            }

            $this->properties = $properties;
        }
    }

    public static function toDto(array $data): static
    {
        $dto = new self(
            id: $data['id'],
            tags: $data['tags'] ?? [],
            lead_score: $data['lead_score'],
            contact_company_id: $data['contact_company_id'] ?? null,
            star_value: $data['star_value'],
        );

        $properties = [];

        foreach ($data['properties'] as $property) {
            $properties[] = new ContactPropertyDto(
                name: ContactSystemPropertyName::tryFrom($property['name']) ?? $property['name'],
                value: $property['value'],
                type: ContactPropertyType::tryFrom($property['type']),
                subtype: ! empty($property['subtype']) ? ContactPropertySubType::tryFrom($property['subtype']) : null,

            );
        }

        $dto->properties = $properties;
        $dto->campaignStatus = $properties['campaignStatus'] ?? [];
        $dto->unsubscribeStatus = $properties['unsubscribeStatus'] ?? [];
        $dto->emailBounceStatus = $properties['emailBounceStatus'] ?? [];
        $dto->created_time = Carbon::parse($data['created_time']);

        return $dto;
    }
}
