<?php

namespace Isapp\AgileCrm\Dto;

use Carbon\CarbonInterface;
use Illuminate\Contracts\Support\Arrayable;
use Isapp\AgileCrm\Contracts\AgileCrmResource;
use Isapp\AgileCrm\Contracts\DtoContract;
use Isapp\AgileCrm\Contracts\EnumContract;
use Isapp\AgileCrm\Contracts\EpochTimeInterface;
use ReflectionClass;
use ReflectionProperty;

use function property_exists;

abstract class Dto implements AgileCrmResource, DtoContract
{
    public function toArray(): array
    {
        $data = [];

        $properties = (new ReflectionClass(static::class))->
        getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $prop = $property->getName();
            $value = $this->{$prop};
            if (! property_exists(static::class, $prop) || \is_null($value)) {
                continue;
            }

            if ($value instanceof Arrayable) {
                $value = $value->toArray();
            } elseif ($value instanceof EnumContract) {
                /** @phpstan-ignore-next-line */
                $value = $value->value;
            } elseif ($value instanceof EpochTimeInterface) {
                /** @phpstan-ignore-next-line */
                $value = $value->unix();
            } elseif ($value instanceof CarbonInterface) {
                /** @phpstan-ignore-next-line */
                $value = $value->format('Y-m-d');
            } elseif (\is_array($value)) {
                $newValue = [];
                foreach ($value as $valueItem) {
                    if ($valueItem instanceof Arrayable) {
                        $newValue[] = $valueItem->toArray();
                    } elseif ($valueItem instanceof EnumContract) {
                        /* @phpstan-ignore-next-line */
                        $newValue[] = $valueItem?->value;
                    } else {
                        $newValue[] = $valueItem;
                    }
                }
                $value = $newValue;
            }
            $data[$prop] = $value;
        }

        return $data;
    }

    abstract public static function toDto(array $data): static;
}
