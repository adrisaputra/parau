<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category as Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "category_name" => "Atap",
            "description" => "Bahan bangunan untuk atap"
        ]);
        Category::create([
            "category_name" => "Lantai",
            "description" => "Bahan bangunan untuk lantai"
        ]);
        Category::create([
            "category_name" => "Dinding",
            "description" => "Bahan bangunan untuk dinding"
        ]);
        Category::create([
            "category_name" => "Perabotan",
            "description" => ""
        ]);
    }
}
