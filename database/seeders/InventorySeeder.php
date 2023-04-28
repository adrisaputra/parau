<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product as Product;
use App\Models\Inventory as Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::all();

        // buat relasi satu kategory untuk satu product
        foreach ($product as $key => $value) {
            $min_stock = 5 * (rand(2, 10)); // random kelipatan 5, 10-50
            $full_stock = $min_stock + 5 * (rand(2, 20)); // random lebih dari minstock
            $in_stock = $full_stock - rand(0, $full_stock); // random kurang dari instock
            Inventory::create([
                "product_id" => $value->id,
                "in_stock" => $in_stock,
                "min_stock" => $min_stock,
                "full_stock" => $full_stock,
            ]);
        }
    }
}
