<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Outlet
        $this->call(OutletSeeder::class);

        // Stok Manajemen
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);  /* use Outlet */
        $this->call(ProductCategorySeeder::class); /* use Product & ProductCategory */
        $this->call(InventorySeeder::class); /* use Product */

        // purchase 
        $this->call(SupplierSeeder::class);
        $this->call(PurchaseTransactionSeeder::class); /* use Supplier */
        $this->call(PurchaseDetailSeeder::class); /* use PurchaseTransaction & Product */

        // selling
        $this->call(MemberSeeder::class);
        $this->call(SellingTransactionSeeder::class); /* use Member */
        $this->call(SellingDetailSeeder::class); /* use SellingTransaction & Product */

        // Project Manajemen
        $this->call(ProjectSeeder::class); /* use Outlet */
        $this->call(ProjectDetailSeeder::class); /* use Project */
    }
}