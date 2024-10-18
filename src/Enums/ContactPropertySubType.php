<?php

namespace IsapOu\AgileCrm\Enums;

use IsapOu\AgileCrm\Contracts\EnumContract;
use RuntimeException;

enum ContactPropertySubType: string implements EnumContract
{
    case WORK = 'work';
    case PERSONAL = 'personal';
    case HOME = 'home';
    case MOBILE = 'mobile';
    case MAIN = 'main';
    case HOME_FAX = 'home fax';
    case WORK_FAX = 'work fax';
    case OTHER = 'other';
    case POSTAL = 'postal';
    case OFFICE = 'office';
    case URL = 'URL';
    case SKYPE = 'SKYPE';
    case TWITTER = 'TWITTER';
    case LINKEDIN = 'LINKEDIN';
    case FACEBOOK = 'FACEBOOK';
    case XING = 'XING';
    case FEED = 'FEED';
    case GOOGLE_PLUS = 'GOOGLE_PLUS';
    case FLICKR = 'FLICKR';
    case GITHUB = 'GITHUB';
    case YOUTUBE = 'YOUTUBE';

    public static function getAvailableByType(ContactSystemPropertyName $name): array
    {
        return match ($name) {
            ContactSystemPropertyName::EMAIL => [
                self::WORK,
                self::PERSONAL,
            ],
            ContactSystemPropertyName::ADDRESS => [
                self::HOME,
                self::POSTAL,
                self::OFFICE,
            ],
            ContactSystemPropertyName::PHONE => [
                self::HOME,
                self::WORK,
                self::MOBILE,
                self::MAIN,
                self::HOME_FAX,
                self::WORK_FAX,
                self::OTHER,
            ],
            ContactSystemPropertyName::WEBSITE => [
                self::URL,
                self::SKYPE,
                self::TWITTER,
                self::LINKEDIN,
                self::FACEBOOK,
                self::XING,
                self::FEED,
                self::GOOGLE_PLUS,
                self::FLICKR,
                self::GITHUB,
                self::YOUTUBE,
            ],
            default => new RuntimeException('Unknown property type: ' . $name->value),
        };
    }
}
