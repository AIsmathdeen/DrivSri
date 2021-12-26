<?php

namespace Database\Seeders;

use App\Enums\LicenseStatusType;
use App\Enums\RoleType;
use App\Models\LicenseHolder;
use App\Models\LicenseStatus;
use App\Models\Policeman;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = User::create([
            'user_name'=>'super_admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('1111aaaa'),
        ]);

        $superUserRole = Role::create(['name' => RoleType::SUPER_ADMIN]);
        $superUser->assignRole($superUserRole);

        $adminUser = User::create([
            'user_name'=>'admin1',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1111aaaa'),
        ]);

        $adminUserRole = Role::create(['name' => RoleType::ADMIN]);
        $adminUser->assignRole($adminUserRole);

        $status=LicenseStatus::where('type',LicenseStatusType::ACTIVE())->first();

        $licenseHolderUser = User::create([
            'user_name'=>'license_holder1',
            'email' => 'license_holder@user.com',
            'password' => Hash::make('1111aaaa'),
        ]);

        $licenseHolderUserRole = Role::create(['name' => RoleType::LICENSE_HOLDER()]);
        $licenseHolderUser->assignRole($licenseHolderUserRole);

        LicenseHolder::factory()->create([
            'user_id'=>$licenseHolderUser->id,
            'status_id'=>$status->id,
        ]);

        $policemanUser = User::create([
            'user_name'=>'policemen1',
            'email' => 'policeman@user.com',
            'password' => Hash::make('1111aaaa'),
        ]);

        $policemanUserRole = Role::create(['name' => RoleType::POLICEMAN()]);
        $policemanUser->assignRole($policemanUserRole);

        Policeman::factory()->create([
            'user_id'=>$policemanUser->id,
        ]);
    }
}
