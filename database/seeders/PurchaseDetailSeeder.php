<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\PurchaseTransaction;
use Carbon\Carbon as Carbon;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PurchaseTransaction = PurchaseTransaction::get();
        $Product = Product::get();
        foreach ($PurchaseTransaction as $key => $val) {
            $amount = rand(1, 10);
            for ($i = 1; $i <= $amount; $i++) {
                $index = rand(0, (count($Product) - 1));
                $amount = rand(1, 10);
                PurchaseDetail::create([
                    "purchase_transaction_id" => $val->id,
                    "product_id" => $Product[$index]->id,
                    "amount" => $amount,
                    "price" => $Product[$index]->purchase_price * $amount,
                ]);
            }
        }

        // UPDATE HARGA PURCHASE TRANSACTION
        $PurchaseDetail = PurchaseDetail::groupBy('purchase_transaction_id')
            ->selectRaw('*, sum(price) as total_price')
            ->get();
        $PurchaseTransaction = PurchaseTransaction::get();
        foreach ($PurchaseTransaction as $key => $val) {
            foreach ($PurchaseDetail as $key2 => $val2) {
                if ($val->id == $val2->purchase_transaction_id) {
                    $PurchaseTransaction[$key]->id = $val->id;
                    $PurchaseTransaction[$key]->pay_cost = $val2->total_price;
                    $PurchaseTransaction[$key]->total_price = $val2->total_price;
                    $PurchaseTransaction[$key]->save();
                }
            }
        }
    }
}
