<?php

namespace App\Http\Controllers;

use App\Models\Product;   //nama model
use App\Models\Inventory;   //nama model
use App\Models\Project;   //nama model
use App\Models\Material;   //nama model
use App\Models\Outlet;   //nama model
use App\Models\SellingDetail;
use App\Models\SellingTransaction;
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Image;

class MaterialController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index($project)
    {
        $title = "Material";
        $project = Project::where('id',$project)->first();
        $transaction_number = Material::select('transaction_number')
                                ->where('project_id',$project->id)
                                ->groupBy('selling_transaction_id')
                                ->orderBy('selling_transaction_id','DESC')->first();
        $in = Material::select('materials.*','products.product_name as product_name2')
                    ->leftJoin('products', 'materials.product_id', '=', 'products.id')
                    ->where('project_id',$project->id)
                    ->where('materials.status',1)
                    ->where('materials.purchase_place','IN')
                    ->orderBy('materials.id','DESC')->get();
        $out = Material::select('materials.*','products.product_name as product_name2')
                    ->leftJoin('products', 'materials.product_id', '=', 'products.id')
                    ->where('project_id',$project->id)
                    ->where('materials.status',1)
                    ->where('materials.purchase_place','OUT')
                    ->orderBy('materials.id','DESC')->get();
        if($transaction_number){
            $selling_transaction = SellingTransaction::where('transaction_number',$transaction_number->transaction_number)->first();
        } else {
            $selling_transaction = NULL;
        }
        return view('admin.material.index',compact('title','project','transaction_number','in','out','selling_transaction'));
    }

    ## Tampilkan Form Create
    public function create($project)
    {
        $title = "Material";
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->get();
        $project = Project::where('id',$project)->first();
        $material = Material::where('project_id',$project->id)->where('status',0)->get();
		$view=view('admin.material.create2',compact('title','product','project','material'));
        $view=$view->render();
        return $view;
    }
    
    public function refresh($project)
    {
        $material = Material::where('project_id',$project)->where('status',0)->get();
        return view('admin.material.refresh', compact('project','material'));
    }

    public function search_box(Request $request, $project)
    {
        $product = $request->get('search');
        $project_id = $project;
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where(function ($query) use ($product) {
            $query->where('code', 'LIKE', '%' . $product . '%')
                ->orWhere('product_name', 'LIKE', '%' . $product . '%');
        })->orderBy('id', 'DESC')->limit(25)->get();

        return view('admin.material.product_search', compact('project_id','product'));
    }

    public function get_modal_data(Request $request, $project)
    {
        $product = $request->get('id');
        $project_id = $project;
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->where('id', $product)->first();
        $material = material::where('project_id', $project_id)->where('product_id', $product->id)->where('status', 0)->first();

        return view('admin.material.modal_product', compact('project_id','product', 'material'));
    }

    public function add_to_cart(Request $request, $project)
    {
        $material = Material::where('project_id', $request->project_id)
                    ->where('product_id', $request->product_id)->where('status', 0);

        $product = Product::find($request->product_id);
        $inventory = Inventory::where('product_id', $request->product_id)->first();

        $cek = $material->count();

        if ($cek) {

            $data = $material->first();

            if(($inventory->in_stock + $data->amount) < $request->amount){
                return 'failed';
            } else {
                $inventory->in_stock = $inventory->in_stock + ($data->amount - $request->amount);
                $inventory->save();
    
                $data->amount = $request->amount;
                $data->price = $request->price;
                // $data->status = 0;
                $data->save();

                return 'success';
            }

        } else {

            $input['project_id'] = $request->project_id;
            $input['purchase_place'] = "IN";
            $input['product_id'] = $request->product_id;
            
            $product = Product::find($request->product_id);
            $input['product_name'] = $product->product_name;
    
            $outlet = Outlet::find(Auth::user()->outlet_id);
            $input['outlet_name'] = $outlet->outlet_name;
    
            $input['price'] = str_replace(".", "", $request->price);
            $input['unit'] = $request->unit;
            $input['amount'] = str_replace(".", "", $request->amount);
            
            $input['date'] = date('Y-m-d');
            $input['status'] = 0;
            
            $inventory = Inventory::where('product_id',$request->product_id)->first();
            $inventory->in_stock = $inventory->in_stock - $request->amount;
            $inventory->save();
        }
        
        
        Material::create($input);

        return 'success';
    }

    public function add_to_cart_barcode(Request $request, $project)
    {
        $product = Product::where('code', $request->code)->first();
        $material = Material::where('project_id', $request->project_id)
                    ->where('product_id', $product->id);

        $inventory = Inventory::where('product_id', $product->id)->first();

       
        $cek = $material->count();
        $amount = 1;

        if ($cek) {

            $data = $material->first();

            if($inventory->in_stock < $amount){
                return 'failed';
            } else {
                $inventory->in_stock = $inventory->in_stock - $amount;
                $inventory->save();
    
                $data->amount = $data->amount + $amount;
                $data->price = $product->selling_price;
                $data->status = 0;
                
                $data->save();

                return 'success';
            }
            
        } else {

            if($inventory->in_stock < $amount){
                
                return 'failed';

            } else { 

                $input['project_id'] = $request->project_id;
                $input['purchase_place'] = "IN";
                $input['product_id'] =  $product->id;
                $input['product_name'] = $product->product_name;
        
                $outlet = Outlet::find(Auth::user()->outlet_id);
                $input['outlet_name'] = $outlet->outlet_name;
        
                $input['price'] = str_replace(".", "", $product->selling_price);
                $input['unit'] = $product->unit;
                $input['amount'] = 1;
                
                $input['date'] = date('Y-m-d');
                $input['status'] = 0;
                
                $inventory = Inventory::where('product_id',$product->id)->first();
                $inventory->in_stock = $inventory->in_stock - 1;
                $inventory->save();
                
                Material::create($input);
                return 'success';
            }
            
        }

    }

    function delete_item(Request $request, $project)
    {
        // update inventory
        $material = Material::find($request['id']);
        $inventory = Inventory::where('product_id', $material->product_id)->first();
        $inventory->in_stock = $inventory->in_stock + $material->amount;
        $inventory->save();

        // delete
        Material::find($request['id'])->delete();
    }

    ## Simpan Data
    public function store($project, Request $request)
    {

        if($request->purchase_place2==''){
            $this->validate($request, [
                'purchase_place' => 'required'
            ]);
        }

        if($request->purchase_place2=='OUT'){
            $this->validate($request, [
                'product_name2' => 'required',
                'outlet_name' => 'required',
                'price2' => 'required',
                'unit2' => 'required',
                'amount2' => 'required',
                'date2' => 'required',
            ]);
        }

        if($request->purchase_place2=='IN'){
            
            $cek_material = material::where('project_id', $project)->where('purchase_place','IN')->whereNotNull('selling_transaction_id')->groupBy('selling_transaction_id')->first();
            $count_material = material::where('project_id', $project)->where('purchase_place','IN')->whereNotNull('selling_transaction_id')->groupBy('selling_transaction_id')->count();
            
            if($count_material==0){
                $index = SellingTransaction::count() + 1;
                $transaction_number =  'TRP' . time() . $index;
                SellingTransaction::create([
                    "transaction_number" => $transaction_number,
                    "status" => 'DONE', //successfully
                    "type" => 'PROJECT', //successfully
                    "transaction_date" => date('Y-m-d H:i:s'), //successfully
                    "user_id" => Auth::user()->id, //admin
                    "member_id" => 1, 
                ]);
                
                $SellingTransaction = SellingTransaction::where('transaction_number',$transaction_number)->first();
            } else {
                $transaction_number = $cek_material->transaction_number;
                $SellingTransaction = SellingTransaction::where('transaction_number',$transaction_number)->first();
            }
            
            SellingDetail::where('selling_transaction_id', $SellingTransaction->id)->delete();
            $material = material::where('project_id', $project)->where('purchase_place','IN')->get();

            foreach($material as $v){

                $material = material::where('id', $v->id)->first();

                $selling_detail = new SellingDetail();
                $selling_detail->selling_transaction_id = $SellingTransaction->id;
                $selling_detail->product_id = $material->product_id;
                $selling_detail->amount = $material->amount;
                $selling_detail->price = $material->price * $material->amount;
                $selling_detail->save();

                $material->selling_detail_id = $selling_detail->id;
                $material->selling_transaction_id = $SellingTransaction->id;
                $material->transaction_number = $transaction_number;
                $material->status = 1;
                $material->save();
            }

            $total_material = SellingDetail::where('selling_transaction_id', $SellingTransaction->id)->sum('price');
            $selling_transaction = SellingTransaction::find($SellingTransaction->id);
            $selling_transaction->total_price = $total_material;
            $selling_transaction->save();


        } else if($request->purchase_place2=='OUT'){
            
            $input['project_id'] = $project;
            $input['product_name'] = $request->product_name2;
            $input['outlet_name'] = $request->outlet_name;
            $input['purchase_place'] = $request->purchase_place2;
            $input['price'] = str_replace(".", "", $request->price2);
            $input['unit'] = $request->unit2;
            $input['amount'] = str_replace(".", "", $request->amount2);

            $d = substr($request->date2,0,2);
            $m = substr($request->date2,3,2);
            $y = substr($request->date2,6,4);
            $input['date'] = $y.'-'.$m.'-'.$d;
            
            Material::create($input);
    
        }
		
        activity()->log('Tambah Data Material');
		return redirect('/material/'.$project)->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($project, Material $material)
    {
        $title = "Material";
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->get();
        $project = Project::where('id',$project)->first();
        $view=view('admin.material.edit', compact('title','product','project','material'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $project, Material $material)
    {
       
        $this->validate($request, [
            'purchase_place' => 'required'
        ]);

        if($request->purchase_place=='IN'){
                
            $stock = Inventory::where('product_id', $request->product_id)->first();
            $qty = $stock->in_stock + $material->amount;

            $this->validate($request, [
                'product_id' => 'required',
                'amount' => 'required|numeric|not_in:0|max:'.$qty,
                'date' => 'required',
            ]);
        } else if($request->purchase_place=='IN'){
            $this->validate($request, [
                'product_name' => 'required',
                'outlet_name' => 'required',
                'price2' => 'required',
                'unit2' => 'required',
                'amount2' => 'required',
                'date2' => 'required',
            ]);
        }

        if($material->purchase_place=="IN"){
            $inventory = Inventory::where('product_id',$material->product_id)->first();
            $inventory->in_stock = $inventory->in_stock + $material->amount;
            $inventory->save();
        }

        // $material->delete();
        
        if($request->purchase_place=='IN'){

            $material->fill($request->all());
            $material->purchase_place = $request->purchase_place;
            $material->product_id = $request->product_id;
            
            $product = Product::find($request->product_id);
            $material->product_name = $product->product_name;
    
            $material->price = str_replace(".", "", $request->price);
            $material->unit = $request->unit;
            $material->amount = str_replace(".", "", $request->amount);
            
            $d = substr($request->date,0,2);
            $m = substr($request->date,3,2);
            $y = substr($request->date,6,4);
            $material->date = $y.'-'.$m.'-'.$d;
            
    	    $material->save();

            $selling_detail = SellingDetail::find($material->selling_detail_id);
            $selling_detail->product_id = $request->product_id;
            $selling_detail->amount = str_replace(".", "", $request->amount);
            $selling_detail->price = str_replace(".", "", $request->price) * str_replace(".", "", $request->amount);
    	    $selling_detail->save();

            $inventory = Inventory::where('product_id',$request->product_id)->first();
            $inventory->in_stock = $inventory->in_stock - $request->amount;
            $inventory->save();
    
        } else {

            // if($material->selling_detail_id!=NULL){
            //     SellingDetail::where('id', $material->selling_detail_id)->delete();
            // }
            
            $material->fill($request->all());
            $material->selling_detail_id = NULL;
            $material->selling_transaction_id = NULL;
            $material->transaction_number = NULL;
            $material->product_name = $request->product_name2;
            $material->outlet_name = $request->outlet_name;
            $material->purchase_place = $request->purchase_place;
            $material->price = str_replace(".", "", $request->price2);
            $material->unit = $request->unit2;
            $material->amount = str_replace(".", "", $request->amount2);

            $d = substr($request->date2,0,2);
            $m = substr($request->date2,3,2);
            $y = substr($request->date2,6,4);
            $material->date = $y.'-'.$m.'-'.$d;

    	    $material->save();
    
        }
		
        activity()->log('Ubah Data Material dengan ID = '.$material->id);
		return redirect('/material/'.$project)->with('status','Data Berhasil Diubah');


    }

    ## Hapus Data
    public function delete($project, Material $material)
    {
        if($material->purchase_place=="IN"){
            $inventory = Inventory::where('product_id',$material->product_id)->first();
            $inventory->in_stock = $inventory->in_stock + $material->amount;
            $inventory->save();
        }

    	$material->delete();
        SellingDetail::where('id', $material->selling_detail_id)->delete();

        $total_material = SellingDetail::where('selling_transaction_id', $material->selling_transaction_id)->sum('price');
        $selling_transaction = SellingTransaction::find($material->selling_transaction_id);
        $selling_transaction->total_price = $total_material;
        $selling_transaction->save();

        activity()->log('Hapus Data Material dengan ID = '.$material->id);
        return redirect('/material/'.$project)->with('status', 'Data Berhasil Dihapus');
    }

    
    function discount(Request $request, $project, SellingTransaction $selling_transaction)
    {
        $selling_transaction->discount = str_replace(".", "", $request->discount);
        $selling_transaction->save();

        activity()->log('Beri Diskon Pembelian Material dengan Selling Transaction ID = '.$selling_transaction->id);
        return redirect('/material/'.$project)->with('status', 'Diskon Berhasil Dimasukkan');
    }
}
