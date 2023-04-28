<?php

namespace App\Http\Controllers;

use App\Models\Supplier;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class SupplierController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    ## Tampikan Data
    public function index()
    {
        $title = "Supplier";
        $supplier = Supplier::where('status', 1)->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.supplier.index', compact('title', 'supplier'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Supplier";
        $supplier = $request->get('search');
        $supplier = Supplier::where('status', 1)->where(function ($query) use ($supplier) {
                        $query->where('supplier_name', 'LIKE', '%' . $supplier . '%')
                        ->orWhere('phone', 'LIKE', '%' . $supplier . '%')
                        ->orWhere('address', 'LIKE', '%' . $supplier . '%');
                    })->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.supplier.index', compact('title', 'supplier'));
    }

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Supplier";
        $view = view('admin.supplier.create', compact('title'));
        $view = $view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->description = $request->description;

        $supplier->save();

        activity()->log('Tambah Data Supplier');
        return redirect('/supplier')->with('status', 'Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Supplier $supplier)
    {
        $title = "Supplier";
        $view = view('admin.supplier.edit', compact('title', 'supplier'));
        $view = $view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'supplier_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $supplier->fill($request->all());
        $supplier->save();

        activity()->log('Ubah Data Supplier dengan ID = ' . $supplier->id);
        return redirect('/supplier')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Supplier $supplier)
    {
        $supplier->status = 0;
    	$supplier->save();
        // $supplier->delete();

        activity()->log('Hapus Data Supplier dengan ID = ' . $supplier->id);
        return redirect('/supplier')->with('status', 'Data Berhasil Dihapus');
    }
}
