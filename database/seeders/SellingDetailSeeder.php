<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\SellingDetail;
use App\Models\SellingTransaction;
use Carbon\Carbon as Carbon;

class SellingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SellingTransaction = SellingTransaction::get();
        $Product = Product::get();
        foreach ($SellingTransaction as $key => $val) {
            $amount = rand(1, 10);
            for ($i = 1; $i <= $amount; $i++) {
                $index = rand(0, (count($Product) - 1));
                $amount = rand(1, 10);
                SellingDetail::create([
                    "selling_transaction_id" => $val->id,
                    "product_id" => $Product[$index]->id,
                    "amount" => $amount,
                    "price" => $Product[$index]->selling_price * $amount,
                ]);
            }
        }

        // UPDATE HARGA PURCHASE TRANSACTION
        $SellingDetail = SellingDetail::groupBy('selling_transaction_id')
            ->selectRaw('*, sum(price) as total_price')
            ->get();
        $SellingTransaction = SellingTransaction::get();
        foreach ($SellingTransaction as $key => $val) {
            foreach ($SellingDetail as $key2 => $val2) {
                if ($val->id == $val2->selling_transaction_id) {
                    $SellingTransaction[$key]->id = $val->id;
                    $SellingTransaction[$key]->pay_cost = $val2->total_price;
                    $SellingTransaction[$key]->total_price = $val2->total_price;
                    $SellingTransaction[$key]->save();
                }
            }
        }
    }
}
