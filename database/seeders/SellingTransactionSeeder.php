<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SellingTransaction as SellingTransaction;

class SellingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 7; $i++) {
            SellingTransaction::create([
                "transaction_number" => ('TRX' . time() . $i),
                "status" => "DONE", //successfully
                "user_id" => 1, //admin
                "member_id" => rand(1, 15), //
            ]);
        }
        // for ($i = 6; $i <= 8; $i++) {
        SellingTransaction::create([
            "transaction_number" => ('CART-' . time() . $i),
            "status" => "CART", // CART
            "user_id" => 1, //admin
            "member_id" => rand(1, 15), //
        ]);
        // }
    }
}
