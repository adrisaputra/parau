<?php

namespace App\Http\Controllers;

use App\Models\Inventory;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class InventoryController extends Controller
{
    ## Tampikan Data
    public function index()
    {
        $title = "Gudang";
        $inventory = Inventory::whereHas('product', function ($product) {
            $product->where('outlet_id', Auth::user()->outlet_id)
                    ->where('status', 1);
        })
            ->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.inventory.index', compact('title', 'inventory'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Gudang";
        $inventory = $request->get('search');
        $inventory = Inventory::whereHas('product', function ($query) use ($inventory) {
            return $query->where('outlet_id', Auth::user()->outlet_id)
                ->where('status', 1)
                ->where('product_name', 'LIKE', '%' . $inventory . '%')
                ->orWhere('code', 'LIKE', '%' . $inventory . '%');
        })
            ->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.inventory.index', compact('title', 'inventory'));
    }
}
