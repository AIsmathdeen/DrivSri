<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PENDING()
 * @method static static PAID()
 * @method static static OVERDUE()
 */

final class PaymentStatusType extends Enum
{
    const PENDING =   'pending';
    const PAID =   'paid';
    const OVERDUE= 'Overdue';

}
