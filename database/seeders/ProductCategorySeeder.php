<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product as Product;
use App\Models\Category as Category;
use App\Models\ProductCategory as ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::all();
        $category = Category::all();

        // buat relasi satu kategory untuk satu product
        foreach ($product as $key => $value) {
            ProductCategory::create([
                "product_id" => $value->id,
                "category_id" => $category[rand(0, (count($category) - 1))]->id, //random id category
            ]);
        }
    }
}
