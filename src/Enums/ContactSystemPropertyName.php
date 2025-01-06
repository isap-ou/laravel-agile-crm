<?php

namespace Isapp\AgileCrm\Enums;

use Isapp\AgileCrm\Contracts\EnumContract;

enum ContactSystemPropertyName: string implements EnumContract
{
    case FIRST_NAME = 'first_name';
    case LAST_NAME = 'last_name';
    case IMAGE = 'image';
    case COMPANY = 'company';
    case TITLE = 'title';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case ADDRESS = 'address';
    case WEBSITE = 'website';

    public static function hasSubType(self $name): bool
    {
        return \in_array($name, [
            self::EMAIL,
            self::PHONE,
            self::ADDRESS,
            self::WEBSITE,
        ]);
    }
}
