<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle_class;

class VehicleClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleClass = [
            [
                'id' => "1",
                'vehicle_class' => "G1",
                'desctription' => "Light motor cycles of which Engine
                Capacity does not exceeds 100CC"
            ],

            [

                'id' => "2",
                'vehicle_class' => "B1",
                'desctription' => "Motor Tricycle or van of which tare does not exceed 500kg and
                 Gross vehicle weight does not exceed 1000 kg: Motor vehicle in this class include
                  an invalid carriage "
            ],

            [

                'id' => "3",
                'vehicle_class' => "B ",
                'desctription' => "Dual purpose Motor vehicle of which Gross Vehicle Weight does not exceed
                 3500kg and the seating capacity does not exceed 9 seats inclusive of the driver’s seat"

            ],

            [

                'id' => "4",
                'vehicle_class' => "C1 ",
                'desctription' => "Light Motor Lorry – Motor Lorry of which Gross Vehicle Weight exceeds
                 3500 kg and does not exceed 17000kg"
            ],

            [

                'id' => "5",
                'vehicle_class' => "C ",
                'desctription' => "Motor Lorry of which Gross vehicle Weight is more than 1700kg"
            ],

            [

                'id' => "6",
                'vehicle_class' => "D1 	",
                'desctription' => "Light Motor Coach- Motor vehicles used for the carriage of persons and
                 having seating capacity of not less than 9 seats and not more than 33 seats
                  inclusive of the driver’s seat"
            ]

            ];
            Vehicle_class::insert($vehicleClass);
    }
}
