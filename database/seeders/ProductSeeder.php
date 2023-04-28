<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as FakerG;
use Faker\Factory as Faker;
use App\Models\Product as Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $purchase_price = [5000, 10000, 15000, 20000, 25000];
        $unit = ['Paket', 'Dos Kecil', 'Batang', 'Lusin', 'Satuan'];
        // $selling_price = [5000,10000,15000, 20000, 25000];

        for ($i = 0; $i <= 29; $i++) {
            $new_product = new Product;

            $new_product->product_name = "Produk " . $faker->firstName();
            $new_product->code = $faker->isbn13();
            $new_product->unit = $unit[rand(0, 4)];
            $new_product->image = "";
            $new_product->description = $faker->Text();
            $new_product->purchase_price = $purchase_price[rand(0, 4)]; //random angka dari $purchase_price
            $new_product->selling_price = $new_product->purchase_price * (rand(1, 4) * 0.05 + 1); //harga beli * (persentase profit)
            $new_product->outlet_id = rand(1, 2);
            $new_product->save();

            // $new_product->Category()->attach(rand(1,3));

            // $new_inventory = new inventory;
            // $new_inventory->product_id = $new_product->id;
            // $stocks = rand(2,6);
            // $new_inventory->min_stock = $stocks*5;
            // $new_inventory->full_stock = rand($stocks+2,30)*5;
            // $in_stock = rand(0,$new_inventory->full_stock);
            // $new_inventory->in_stock =  $in_stock;

            // $new_inventory->save();
        }
    }
}
