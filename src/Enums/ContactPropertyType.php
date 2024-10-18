<?php

namespace IsapOu\AgileCrm\Enums;

use IsapOu\AgileCrm\Contracts\EnumContract;

enum ContactPropertyType: string implements EnumContract
{
    case SYSTEM = 'SYSTEM';
    case CUSTOM = 'CUSTOM';

}
