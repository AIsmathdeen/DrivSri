<?php

namespace Database\Seeders;

use App\Models\Fine;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Offense;

class FinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fines = [
            [
                'section_of_act' => "Section 21",
                'provision' => "Identification Plates",
                'fine_amount' => 1000,
                'demerit_points' => 3
            ],
            [
                'section_of_act' => "Section 38",
                'provision' => "Revenue Licence to be displayed on motor vehicles and produced when required",
                'fine_amount' => 1000,
                'demerit_points' => 3
            ],

            [
                'section_of_act' => "Section 45",
                'provision' => "Prohibition on the use of the motor vehicle in contravention of the provisions of revenue licens",
                'fine_amount' => 1000,
                'demerit_points' => 3
            ],

            [
                'section_of_act' => "Section 128A",
                'provision' => "Failure to obtain authorization to drive emergency service vehicles and public service vehicles",
                'fine_amount' => 2500,
                'demerit_points' => 3
            ],

            [
                'section_of_act' => "Section 128B",
                'provision' => "Driving a special purpose vehicle without obtaining a license",
                'fine_amount' => 1000,
                'demerit_points' => 3
            ],

            [
                'section_of_act' => "Section 128C",
                'provision' => "Failure to obtain authorization to drive a vehicle loaded with chemicals, hazardous waste",
                'fine_amount' => 1500,
                'demerit_points' => 3
            ],
            [
                'section_of_act' => "Section 130",
                'provision' => "Failure to have a license to drive a specific class of vehicle",
                'fine_amount' =>  3000,
                'demerit_points' => 3
            ],

        ];
        Fine::insert($fines);
    }

}
