<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SUPER_ADMIN()
 * @method static static ADMIN()
 * @method static static LICENSE_HOLDER()
 * @method static static POLICEMAN()
 */
final class RoleType extends Enum
{
    const SUPER_ADMIN = 'super-admin';
    const ADMIN = 'admin';
    const LICENSE_HOLDER = 'license-holder';
    const POLICEMAN = 'policeman';
}
