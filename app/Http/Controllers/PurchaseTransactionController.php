<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Models\PurchaseTransaction;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseTransactionController extends Controller
{
    public function index()
    {
        $title = "Riwayat Pembelian";
        $supplier = Supplier::all();
        $purchaseTransaction =  PurchaseTransaction::whereHas('user', function ($q) {
            $q->where('outlet_id', Auth::user()->outlet_id);
        })
            ->where("status", 'DONE')->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/purchase/index', compact('title', 'purchaseTransaction', 'supplier'));
    }

    public function search(Request $request)
    {
        $title = "Riwayat Pembelian";
        $supplier = Supplier::all();
        $search = $request->get('search');
        $purchaseTransaction = PurchaseTransaction::whereHas('user', function ($q) {
            $q->where('outlet_id', Auth::user()->outlet_id);
        })->where("status", 'DONE')
            ->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('transaction_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('pay_cost', 'LIKE', '%' . $search . '%')
                        ->orWhere('total_price', 'LIKE', '%' . $search . '%')
                        ->orWhere('transaction_date', 'LIKE', '%' . $search . '%');
                })
                    ->orwhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('supplier', function ($query) use ($search) {
                        $query->where('supplier_name', 'LIKE', '%' . $search . '%');
                    });
            })->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/purchase/index', compact('title', 'purchaseTransaction', 'supplier'));
    }

    ## Detail Form View
    public function detail($id)
    {
        $title = "Detail Pembelian";
        $purchaseTransaction = PurchaseTransaction::find($id);
        $purchaseDetail = PurchaseDetail::with('product')->where('purchase_transaction_id', $id)->get();
        // dd($purchaseDetail);
        $view = view('admin.purchase.detail', compact('title', 'purchaseDetail', 'purchaseTransaction'));
        $view = $view->render();
        return $view;
    }
}
