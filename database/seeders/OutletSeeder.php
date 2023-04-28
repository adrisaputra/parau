<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Outlet as Outlet;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        Outlet::create([
            "outlet_name" => "Outlet Kendari",
            "phone"       => $faker->PhoneNumber(),
            "address"     => $faker->Address(),
            "description" => $faker->Text()
        ]);
        Outlet::create([
            "outlet_name" => "Outlet Bombana",
            "phone"       => $faker->PhoneNumber(),
            "address"     => $faker->Address(),
            "description" => $faker->Text()
        ]);
        // for ($i = 0; $i <= 14; $i++) {
        //     $outlet = new Outlet();

        //     $outlet->outlet_name = $faker->Company();
        //     $outlet->phone = $faker->PhoneNumber();
        //     $outlet->address = $faker->Address();
        //     $outlet->description = $faker->Text();
        //     $outlet->save();
        // }
    }
}
