<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellingDetail;
use App\Models\SellingTransaction;
use App\Models\Product;
use App\Models\ProductCategory;
// use App\Models\Member;
use App\Models\Inventory;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\UriPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class CashierController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kasir";
        // $member = Member::all();
        $sellingTransaction =  SellingTransaction::where("status", 'CART')
            ->whereHas('user', function ($q) {
                $q->where('outlet_id', Auth::user()->outlet_id);
            })
            ->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/cashier/index', compact('title', 'sellingTransaction'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Kasir";
        // $member = Member::all();
        $search = $request->get('search');
        $sellingTransaction = SellingTransaction::where("status", 'CART')
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
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    });
            })->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/cashier/index', compact('title', 'sellingTransaction'));
    }

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Kasir";
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->orderBy('id', 'DESC')->limit(20)->get();
        // $member = Member::all();
        $sellingDetail = SellingDetail::whereHas('sellingTransaction', function ($query) {
            $query->where('status', 'CART');
        })->orderBy('id', 'DESC')->get();
        $sellingTransaction = sellingTransaction::where('status', 'CART')->first();
       
        if (!$sellingTransaction) {
            $index = SellingTransaction::count() + 1;
            SellingTransaction::create([
                "transaction_number" => ('CART' . time() . $index),
                "status_id" => 4, //successfully
                "type" => 'CASHIER', //successfully
                "user_id" => Auth::user()->id, //admin
                "member_id" => 1, 
            ]);
        }

        $sellingTransaction = sellingTransaction::where('status', 'CART')->first();
        $sellingTransaction2 = sellingTransaction::where(function($query) {
                                    $query->where('status', 'HOLD')
                                        ->orWhere('status', 'CART');
                                })->orderBy('id', 'DESC')->get();

        $view = view('admin.cashier.create2', compact('title', 'product', 'sellingDetail', 'sellingTransaction','sellingTransaction2'));
        $view = $view->render();
        return $view;
    }

    ## Tampilkan Form Create
    public function create_search($selling_transaction_id)
    {
        $title = "Kasir";
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->orderBy('id', 'DESC')->limit(20)->get();
        // $member = Member::all();
        $sellingDetail = SellingDetail::whereHas('sellingTransaction', function ($query) use ($selling_transaction_id){
            $query->where('selling_transaction_id', $selling_transaction_id);
        })->orderBy('id', 'DESC')->get();
        $sellingTransaction2 = sellingTransaction::where(function($query) {
                                    $query->where('status', 'HOLD')
                                        ->orWhere('status', 'CART');
                                })->orderBy('id', 'DESC')->get();


        $sellingTransaction = sellingTransaction::where('id', $selling_transaction_id)->first();

        $view = view('admin.cashier.create2', compact('title', 'product', 'sellingDetail', 'sellingTransaction','sellingTransaction2'));
        $view = $view->render();
        return $view;
    }

    public function search_box(Request $request)
    {
        $product = $request->get('search');
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where(function ($query) use ($product) {
            $query->where('code', 'LIKE', '%' . $product . '%')
                ->orWhere('product_name', 'LIKE', '%' . $product . '%');
        })->orderBy('id', 'DESC')->limit(25)->get();

        return view('admin.cashier.product_search', compact('product'));
    }

    public function get_modal_data(Request $request)
    {
        $product = $request->get('id');
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where('id', $product)->first();
        $sellingDetail = SellingDetail::where('product_id', $product->id)
            ->whereHas('sellingTransaction', function ($query) {
                $query->where('status', 'CART');
            })->first();
        $sellingTransaction = SellingTransaction::with("user")
            ->where("status", 'CART')->first();

        return view('admin.cashier.modal_product', compact('product', 'sellingTransaction', 'sellingDetail'));
    }

    public function get_modal_data_search($selling_transaction_id, Request $request)
    {
        $product = $request->get('id');
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where('id', $product)->first();
        $sellingDetail = SellingDetail::where('product_id',$product->id)
            ->whereHas('sellingTransaction', function ($query) use ($selling_transaction_id){
                $query->where('id', $selling_transaction_id);
            })->first();
        $sellingTransaction = SellingTransaction::with("user")->where("id", $selling_transaction_id)->first();

        return view('admin.cashier.modal_product', compact('product', 'sellingTransaction', 'sellingDetail'));
    }

    public function refresh()
    {
        $sellingDetail = SellingDetail::whereHas('sellingTransaction', function ($query) {
            $query->where('status', 'CART');
        })->orderBy('id', 'DESC')->get();

        return view('admin.cashier.refresh', compact('sellingDetail'));
    }

    public function refresh_search($selling_transaction_id)
    {
        $sellingDetail = SellingDetail::where('selling_transaction_id', $selling_transaction_id)->orderBy('id', 'DESC')->get();

        return view('admin.cashier.refresh', compact('sellingDetail'));
    }

    public function add_to_cart(Request $request)
    {
        $selling = SellingDetail::where('selling_transaction_id', $request->selling_transaction_id)
                    ->where('product_id', $request->product_id);

        $product = Product::find($request->product_id);
        $inventory = Inventory::where('product_id', $request->product_id)->first();

       
        $cek = $selling->count();

        if ($cek) {

            $data = $selling->first();

            if(($inventory->in_stock + $data->amount) < $request->amount){
                return 'failed';
            } else {
                $inventory->in_stock = $inventory->in_stock + ($data->amount - $request->amount);
                $inventory->save();
    
                $data->amount = $request->amount;
                $data->price = $product->selling_price * $request->amount;
                $data->save();

                return 'success';
            }
            
        } else {

            if($inventory->in_stock < $request->amount){
                
                return 'failed';

            } else {

                $input['selling_transaction_id'] = $request->selling_transaction_id;
                $input['product_id'] = $request->product_id;
                $input['amount'] = $request->amount;
                $input['price'] =  $product->selling_price * $request->amount;
                SellingDetail::create($input);
    
                $inventory->in_stock = $inventory->in_stock - $request->amount;
                $inventory->save();
                
                return 'success';
            }
            
        }

    }

    public function add_to_cart_barcode(Request $request)
    {
        $product = Product::where('code', $request->code)->first();
        $selling = SellingDetail::where('selling_transaction_id', $request->selling_transaction_id)
                    ->where('product_id', $product->id);

        $inventory = Inventory::where('product_id', $product->id)->first();

       
        $cek = $selling->count();
        $amount = 1;

        if ($cek) {

            $data = $selling->first();

            if($inventory->in_stock < $amount){
                return 'failed';
            } else {
                $inventory->in_stock = $inventory->in_stock - $amount;
                $inventory->save();
    
                $data->amount = $data->amount + $amount;
                $data->price = $product->selling_price * $data->amount;
                
                $data->save();

                return 'success';
            }
            
        } else {

            if($inventory->in_stock < $amount){
                
                return 'failed';

            } else {

                $input['selling_transaction_id'] = $request->selling_transaction_id;
                $input['product_id'] = $product->id;
                $input['amount'] = $amount;
                $input['price'] =  $product->selling_price * $amount;
                SellingDetail::create($input);
    
                $inventory->in_stock = $inventory->in_stock - $amount;
                $inventory->save();
                
                return 'success';
            }
            
        }

    }

    function delete_item(Request $request)
    {
        // update inventory
        $selling = SellingDetail::find($request['id']);
        $inventory = Inventory::where('product_id', $selling->product_id)->first();
        $inventory->in_stock = $inventory->in_stock + $selling->amount;
        $inventory->save();

        // delete
        SellingDetail::find($request['id'])->delete();
    }


    public static function order(Request $request)
    {
        $count = SellingTransaction::count() + 1;
        $SellingTransaction = SellingTransaction::find($request->selling_transaction_id);
        $SellingTransaction->transaction_number = ('TRX' . time() . $count);
        $SellingTransaction->status = 'DONE';
        // $SellingTransaction->user_id =  Auth::user()->id;
        // $SellingTransaction->member_id = $request->member_id;
        $SellingTransaction->total_price = $request->total_price;
        $SellingTransaction->pay_cost = str_replace(".", "", $request->pay_cost);
        $SellingTransaction->discount = str_replace(".", "", $request->discount);
        $SellingTransaction->transaction_date = $request->transaction_date;
        $SellingTransaction->save();

        // $sellingDetail = SellingDetail::where('selling_transaction_id', $request->selling_transaction_id)->get();
        // foreach ($sellingDetail as $v) {
        //     // STORE TO INVENTORY
        //     $inventory =  Inventory::where('product_id', $v->product_id)->first();
        //     $inventory->in_stock = $inventory->in_stock - $v->amount;
        //     $inventory->save();
        // }

        $sellingTransaction = SellingTransaction::where('status','DONE')->orderBy('id', 'desc')->first();
        $sellingDetail = SellingDetail::where('selling_transaction_id',$sellingTransaction->id)->get();
    	$pdf = PDF::loadview('admin.cashier.report_pdf',[
            'sellingTransaction'=>$sellingTransaction,
            'sellingDetail'=>$sellingDetail
            ])->setPaper('a4', 'protait');
        return view('admin.cashier.report_pdf', compact('sellingTransaction','sellingDetail'));

    }

    public static function print(Request $request)
    {
        $sellingTransaction = SellingTransaction::where('status','DONE')->orderBy('id', 'desc')->first();
        $sellingDetail = SellingDetail::where('selling_transaction_id',$sellingTransaction->id)->get();
    	$pdf = PDF::loadview('admin.cashier.report_pdf',[
                        'sellingTransaction'=>$sellingTransaction,
                        'sellingDetail'=>$sellingDetail
                        ])->setPaper('A8', 'protait');
        return view('admin.cashier.report_pdf2', compact('sellingTransaction','sellingDetail'));
    }

    ## Hapus Data
    public function delete(SellingTransaction $selling_transaction)
    {

        $selling_transaction->delete();

        activity()->log('Hapus Data Keranjang dengan ID = ' . $selling_transaction->id);
        return redirect('/cashier/create')->with('status', 'Data Berhasil Dihapus');
    }

    ## Hapus Data
    public function hold(SellingTransaction $selling_transaction)
    {

        $selling_transaction->status = 'HOLD';
    	$selling_transaction->save();

        activity()->log('Hold Data Keranjang dengan ID = ' . $selling_transaction->id);
        return redirect('/cashier/create')->with('status', 'Data Berhasil Dihold');
    }

    public function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    
    public function print2()
    {
        $profile = CapabilityProfile::load("simple");
        
        /* Start the printer */
        // $logo = EscposImage::load("resources/escpos-php.png", false);

        $connector = new WindowsPrintConnector("COM3");
        $printer = new Printer($connector, $profile);
        

        $sellingTransaction = SellingTransaction::where('status','DONE')->orderBy('id', 'desc')->first();
        $sellingDetail = SellingDetail::where('selling_transaction_id',$sellingTransaction->id)->get();

        /* Print top logo */
        // $printer -> setJustification(Printer::JUSTIFY_CENTER);
        // $printer -> graphics($logo);

        // $printer->initialize();
        // $printer->setFont(Printer::MODE_FONT_A);
        // $printer->setJustification(Printer::JUSTIFY_CENTER);
        // $printer->text("Dr.Astrid L. Harianto, M.Kes,Sp.KK \n");

        // $printer->initialize();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("PARAU.ID \n");
        $printer->text($sellingTransaction->user->outlet->address."\n");
        $printer->text($sellingTransaction->user->outlet->outlet_name." \n");
        $printer->text("No.Hp : ".$sellingTransaction->user->outlet->phone." \n");
        $printer->text("================================\n");

        $printer->initialize();
        $printer->setFont(Printer::MODE_FONT_B);
        
        $line = sprintf('%0.40s %-6s %0.40s %0s %18.40s',$sellingTransaction->created_at->format('D,d-m-Y'),'','','',$sellingTransaction->user->name);
        $printer->text($line."\n");
        // $printer->text($sellingTransaction->created_at->format('D,d-m-Y')." \n");
        $printer->text("Waktu :".$sellingTransaction->created_at->format('H:i')." \n");
        // $printer->text("Kasir :".$sellingTransaction->user->name." \n");
        $printer->text($sellingTransaction->transaction_number." \n");
        $printer->text("\n");

        foreach($sellingDetail as $v) {
            $harga = number_format($v->product->selling_price, 0, ',', '.');
            $jumlah = number_format($v->amount, 0, ',', '.');
            $total = number_format($v->amount * $v->product->selling_price, 0, ',', '.');
            
            $printer->initialize();
            $printer->text($v->product->product_name." \n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            
            // $line = sprintf('%1s %5s %10s ',$jumlah.' X '.$harga,': ',$total);
            $line = sprintf('%-3.40s %-3s %8.40s %1s %13.40s',$jumlah, 'X', $harga, ':',$total);
            $printer -> text("$line\n");
            
        } 

        $printer->initialize();
        $printer->setFont(Printer::MODE_FONT_B);
        $printer->initialize();
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("--------------------------------\n");
        $line = sprintf('%-3.40s %-3s %6.40s %0s %13.40s','Total','','',':',number_format($sellingTransaction->total_price, 0, ',', '.'));
        $printer->text($line."\n");
        
        $line = sprintf('%-3.40s %-3s %6.40s %0s %13.40s','Bayar','','',':',number_format($sellingTransaction->pay_cost, 0, ',', '.'));
        $printer->text($line."\n");
        $line = sprintf('%-3.40s %-3s %4.40s %0s %13.40s','Kembali','','',':',number_format($sellingTransaction->pay_cost - $sellingTransaction->total_price, 0, ',', '.'));
        $printer->text($line."\n");
        $printer->text("\n"); 
        
        $printer->initialize();
        $printer->setFont(Printer::MODE_FONT_B);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("------------------------------------------\n");
        $printer->text("*** Terima Kasih *** \n");
        $printer->text("Atas Kunjungan Anda \n");
        $printer->text("------------------------------------------\n");

        /* Cut the receipt and open the cash drawer */
        
		$printer->feed(1); // mencetak 5 baris kosong, agar kertas terangkat ke atas
        $printer -> cut();
        $printer -> pulse();

        $printer -> close();

        return redirect('cashier/create');
    
    }

}
