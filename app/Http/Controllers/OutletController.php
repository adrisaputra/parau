<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Outlet;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class OutletController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    ## Tampikan Data
    public function index()
    {
        $title = "Outlet";
        $outlet = Outlet::orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.outlet.index', compact('title', 'outlet'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Outlet";
        $outlet = $request->get('search');
        $outlet = Outlet::where(function ($query) use ($outlet) {
            $query->where('outlet_name', 'LIKE', '%' . $outlet . '%');
            // ->orWhere();
        })
            ->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.outlet.index', compact('title', 'outlet'));
    }

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Outlet";
        $lat = "-3.974809556959808";
        $long = "122.51639499313075";
        $view = view('admin.outlet.create', compact('title', 'lat', 'long'));
        $view = $view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $outlet = new Outlet();
        $outlet->outlet_name = $request->outlet_name;
        $outlet->phone = $request->phone;
        $outlet->address = $request->address;
        $outlet->lat = $request->lat;
        $outlet->long = $request->long;
        $outlet->description = $request->description;

        $outlet->save();

        activity()->log('Tambah Data Outlet');
        return redirect('/outlet')->with('status', 'Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Outlet $outlet)
    {
        $title = "Outlet";
        $view = view('admin.outlet.edit', compact('title', 'outlet'));
        $view = $view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Outlet $outlet)
    {
        $this->validate($request, [
            'outlet_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);
        $outlet->fill($request->all());
        $outlet->save();

        activity()->log('Ubah Data Outlet dengan ID = ' . $outlet->id);
        return redirect('/outlet')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Outlet $outlet)
    {
        $outlet->delete();

        activity()->log('Hapus Data Outlet dengan ID = ' . $outlet->id);
        return redirect('/outlet')->with('status', 'Data Berhasil Dihapus');
    }
}
