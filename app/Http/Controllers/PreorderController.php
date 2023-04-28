<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Models\PurchaseTransaction;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PreorderController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Pre Order (PO)";
        $supplier = Supplier::all();
        $purchaseTransaction =  PurchaseTransaction::where("status", 'PO')
            ->whereHas('user', function ($q) {
                $q->where('outlet_id', Auth::user()->outlet_id);
            })
            ->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/preorder/index', compact('title', 'purchaseTransaction', 'supplier'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Pre Order (PO)";
        $supplier = Supplier::all();
        $search = $request->get('search');
        $purchaseTransaction = PurchaseTransaction::where("status", 'PO')
            ->whereHas('user', function ($q) {
                $q->where('outlet_id', Auth::user()->outlet_id);
            })
            ->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('transaction_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('pay_cost', 'LIKE', '%' . $search . '%')
                        ->orWhere('total_price', 'LIKE', '%' . $search . '%')
                        ->orWhere('transaction_date', 'LIKE', '%' . $search . '%');
                })
                    ->orwhereHas('user', function ($query) use ($search) {
                        $query->where('qname', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('supplier', function ($query) use ($search) {
                        $query->where('supplier_name', 'LIKE', '%' . $search . '%');
                    });
            })->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/preorder/index', compact('title', 'purchaseTransaction', 'supplier'));
    }

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Pre Order (PO)";
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->orderBy('id', 'DESC')->limit(20)->get();
        $supplier = Supplier::all();
        $purchaseDetail = PurchaseDetail::whereHas('purchaseTransaction', function ($query) {
            $query->where('status', 'CART');
        })->orderBy('id', 'DESC')->get();
        $purchaseTransaction = purchaseTransaction::where('status', 'CART')->first();

        if (!$purchaseTransaction) {
            $index = PurchaseTransaction::count() + 1;
            PurchaseTransaction::create([
                "transaction_number" => ('PO-' . time() . $index),
                "status_id" => 4, //successfully
                "user_id" => Auth::user()->id, //admin
                "supplier_id" => 1, //
            ]);
        }

        $purchaseTransaction = purchaseTransaction::where('status', 'CART')->first();

        $view = view('admin.preorder.create', compact('title', 'product', 'supplier', 'purchaseDetail', 'purchaseTransaction'));
        $view = $view->render();
        return $view;
    }

    public function search_box_po(Request $request)
    {
        $product = $request->get('search');
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where(function ($query) use ($product) {
            $query->where('code', 'LIKE', '%' . $product . '%')
                ->orWhere('product_name', 'LIKE', '%' . $product . '%');
        })->orderBy('id', 'DESC')->limit(25)->get();

        return view('admin.preorder.product_search', compact('product'));
    }

    public function get_modal_data_po(Request $request)
    {
        $product = $request->get('id');
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where('id', $product)->first();
        $purchaseDetail = PurchaseDetail::where('product_id', $product->id)
            ->whereHas('purchaseTransaction', function ($query) {
                $query->where('status', 'CART');
            })->first();
        $purchaseTransaction = PurchaseTransaction::with("user", "supplier")
            ->where("status", 'CART')->first();

        return view('admin.preorder.modal_product', compact('product', 'purchaseTransaction', 'purchaseDetail'));
    }

    public function refresh()
    {
        $purchaseDetail = PurchaseDetail::whereHas('purchaseTransaction', function ($query) {
            $query->where('status', 'CART');
        })->orderBy('id', 'DESC')->get();

        return view('admin.preorder.refresh', compact('purchaseDetail'));
    }

    public function add_to_cart_po(Request $request)
    {
        $purchase = PurchaseDetail::where('purchase_transaction_id', $request->purchase_transaction_id)
            ->where('product_id', $request->product_id);

        $product = Product::find($request->product_id);

        $cek = $purchase->count();

        if ($cek) { //if product already in cart
            $data = $purchase->first(); //get purchase row

            //update cart in purchase 
            $data->amount = $request->amount;
            $data->price = $product->purchase_price * $request->amount;
            $data->save();
        } else {
            $input['purchase_transaction_id'] = $request->purchase_transaction_id;
            $input['product_id'] = $request->product_id;
            $input['amount'] = $request->amount;
            $input['price'] =  $product->purchase_price * $request->amount;
            PurchaseDetail::create($input);
        }
    }

    function delete_item_po(Request $request)
    {
        PurchaseDetail::find($request['id'])->delete();
    }


    public static function order(Request $request)
    {
        $PurchaseTransaction = PurchaseTransaction::find($request->purchase_transaction_id);
        $PurchaseTransaction->status = 'PO';
        // $PurchaseTransaction->user_id =  Auth::user()->id;
        $PurchaseTransaction->supplier_id = $request->supplier_id;
        $PurchaseTransaction->total_price = $request->total_price;
        $PurchaseTransaction->save();
    }

    ## Hapus Data
    public function delete(PurchaseTransaction $purchase_transaction)
    {

        $purchase_transaction->delete();

        activity()->log('Hapus Data PO dengan ID = ' . $purchase_transaction->id);
        return redirect('/preorder')->with('status', 'Data Berhasil Dihapus');
    }

    ## Confirm Form View
    public function confirm($id)
    {
        $title = "Konfirmasi Pre Order";
        $purchaseTransaction = PurchaseTransaction::find($id);
        $purchaseDetail = PurchaseDetail::with('product')->where('purchase_transaction_id', $id)->get();
        // dd($purchaseDetail);
        $view = view('admin.preorder.confirm', compact('title', 'purchaseDetail', 'purchaseTransaction'));
        $view = $view->render();
        return $view;
    }

    public function confirm_ship(Request $request)
    {
        // dd($request);
        // return 0;    
        $purchase_transaction_id = $request['purchase_transaction_id'];
        $purchase_detail_id = $request['id'];
        $product_id = $request['product_id'];
        $amount = $request['amount'];
        $purchase_price = $request['purchase_price'];
        $selling_price = $request['selling_price'];

        $total_price = 0;
        foreach ($purchase_detail_id as  $i => $id) {

            $this->validate($request, [
                'selling_price.*' => 'required|numeric',
            ]);
            
            // UPDATE PRODUCT PRICE
            $product =  Product::find($product_id[$i]);
            $product->purchase_price = $purchase_price[$i];
            $product->selling_price = $selling_price[$i];
            $product->save();

            // UPDATE PURCHASE DETAIL
            // if ($amount[$i] > 0) {
            $purchase = PurchaseDetail::find($id);
            $purchase->amount = $amount[$i];
            $purchase->price = $amount[$i] * $purchase_price[$i];
            $purchase->save();
            // } else
            //     $purchase = PurchaseDetail::find($id)->delete();

            // STORE TO INVENTORY
            $inventory =  Inventory::where('product_id', $product_id[$i])->first();
            $inventory->in_stock = $inventory->in_stock + $amount[$i];
            $inventory->save();

            // SUM TOTAL PRICE
            $total_price += $amount[$i] * $purchase_price[$i];
        }

        // UPDATE TRANSACTION
        $purchase_transaction = PurchaseTransaction::find($purchase_transaction_id);
        $purchase_transaction->transaction_number   = 'TRX' . time()  . $i;
        $purchase_transaction->pay_cost             = $total_price;
        $purchase_transaction->total_price          = $total_price;
        $purchase_transaction->status               = 'DONE';
        $purchase_transaction->save();

        return redirect('/preorder')->with('status', 'Data Berhasil Dikonfirmasi');
    }
}
