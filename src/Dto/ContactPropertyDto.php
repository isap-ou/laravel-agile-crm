<?php

namespace IsapOu\AgileCrm\Dto;

use InvalidArgumentException;
use IsapOu\AgileCrm\Contracts\EnumContract;
use IsapOu\AgileCrm\Enums\ContactPropertySubType;
use IsapOu\AgileCrm\Enums\ContactPropertyType;
use IsapOu\AgileCrm\Enums\ContactSystemPropertyName;

final class ContactPropertyDto extends Dto
{
    public function __construct(
        public string|ContactSystemPropertyName $name,
        public string $value = '',
        public ?ContactPropertyType $type = null,
        public ?ContactPropertySubType $subtype = null
    ) {
        if ($this->type === null) {
            $this->type = $this->name instanceof EnumContract ? ContactPropertyType::SYSTEM : ContactPropertyType::CUSTOM;
        }

        if ($this->type === ContactPropertyType::CUSTOM) {
            return;
        }

        if (! ContactSystemPropertyName::hasSubType($this->name)) {
            return;
        }

        if ($subtype === null) {
            return;
        }

        if (! \in_array($subtype, ContactPropertySubType::getAvailableByType($this->name), true)) {
            throw new InvalidArgumentException("Subtype for '{$this->name}' is not available");
        }
    }

    public static function toDto(array $data): static
    {
        // TODO: Implement toDto() method.
    }
}
