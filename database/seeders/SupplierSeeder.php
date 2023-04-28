<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Supplier as Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        Supplier::create([
            "supplier_name"   => "UMUM",
            "phone" => "-",
            "address"   => "-",
            "description"   => "-",
        ]);
        for ($i = 1; $i <= 14; $i++) {
            $new_supplier = new Supplier();

            $new_supplier->supplier_name = $faker->Company();
            $new_supplier->phone = $faker->PhoneNumber();
            $new_supplier->address = $faker->Address();
            $new_supplier->description = $faker->Text();
            $new_supplier->save();
        }
    }
}
