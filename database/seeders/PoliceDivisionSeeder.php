<?php

namespace Database\Seeders;

use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Police_division;

class PoliceDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $police_division = [
            [
                'name' => "Dehiwela",
            ],
            [
                'name' => "Kohuwala",

            ],
        ];
        Police_division::insert($police_division);
    }
}
