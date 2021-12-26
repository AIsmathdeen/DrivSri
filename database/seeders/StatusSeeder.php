<?php

namespace Database\Seeders;

use App\Enums\LicenseStatusType;
use App\Enums\PaymentStatusType;
use App\Models\LicenseStatus;
use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LicenseStatus::create([
            'type'=>LicenseStatusType::ACTIVE(),
        ]);

        LicenseStatus::create([
            'type'=>LicenseStatusType::SUSPENDED1(),
        ]);

        LicenseStatus::create([
            'type'=>LicenseStatusType::SUSPENDED2(),
        ]);
        LicenseStatus::create([
            'type'=>LicenseStatusType::SUSPENDED3(),
        ]);

        PaymentStatus::create([
            'type'=>PaymentStatusType::PENDING(),
        ]);

        PaymentStatus::create([
            'type'=>PaymentStatusType::PAID(),
        ]);
        PaymentStatus::create([
            'type'=>PaymentStatusType::OVERDUE(),
        ]);


    }
}
