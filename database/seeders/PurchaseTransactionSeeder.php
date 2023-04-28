<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseTransaction as PurchaseTransaction;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            PurchaseTransaction::create([
                "transaction_number" => ('TRX' . time() . $i),
                "status" => "DONE", //successfully
                "user_id" => 1, //admin
                "supplier_id" => rand(1, 5), //
            ]);
        }
        for ($i = 6; $i <= 8; $i++) {
            PurchaseTransaction::create([
                "transaction_number" => ('PO-' . time() . $i),
                "status" => "PO", //Pre Order
                "user_id" => 1, //admin
                "supplier_id" => rand(1, 5),
            ]);
        }
    }
}
