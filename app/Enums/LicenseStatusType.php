<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ACTIVE()
 * @method static static SUSPENDED1()
 * @method static static SUSPENDED2()
 * @method static static SUSPENDED3()

 */
final class LicenseStatusType extends Enum
{
    const ACTIVE =   'Active';
    const SUSPENDED1 =   'Suspended 12 Months';
    const SUSPENDED2 =   'Suspended 14 Months';
    const SUSPENDED3 =   'Suspended 16 Months';
}
