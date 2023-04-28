<?php

namespace App\Http\Controllers;

use App\Models\Product;   //nama model
use App\Models\Category;   //nama model
use App\Models\Inventory;   //nama model
use App\Models\ProductCategory;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use PDF;

class ProductController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    ## Tampikan Data
    public function index()
    {
        $title = "Produk";
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.product.index', compact('title', 'product'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Produk";
        $product = $request->get('search');
        $product = Product::where('status', 1)->where('outlet_id', Auth::user()->outlet_id)
            ->where(function ($query) use ($product) {
                $query->where('code', 'LIKE', '%' . $product . '%')
                    ->orWhere('product_name', 'LIKE', '%' . $product . '%')
                    ->orWhere('purchase_price', 'LIKE', '%' . $product . '%')
                    ->orWhere('selling_price', 'LIKE', '%' . $product . '%');
            })
            ->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.product.index', compact('title', 'product'));
    }

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Produk";
        $category = Category::get();
        $view = view('admin.product.create', compact('title', 'category'));
        $view = $view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'code' => 'unique:products',
            'product_name' => 'required',
            'unit' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'min_stock' => 'required',
            'full_stock' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:500',
        ]);

        $product = new Product();
        $product->code = $request->code;
        $product->product_name = $request->product_name;
        $product->unit = $request->unit;
        $product->outlet_id = Auth::user()->outlet_id;
        $product->purchase_price = str_replace(".", "", $request->purchase_price);
        $product->selling_price = str_replace(".", "", $request->selling_price);

        if ($request->file('image')) {
            $product->image = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/product_image', $product->image);
            $request->file('image')->storeAs('public/upload/product_image/thumbnail', $product->image);

            $thumbnailpath = public_path('storage/upload/product_image/thumbnail/' . $product->image);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }

        $product->save();

        $inventory = new Inventory();
        $inventory->product_id = $product->id;
        $inventory->min_stock = str_replace(".", "", $request->min_stock);
        $inventory->full_stock = str_replace(".", "", $request->full_stock);
        $inventory->save();

        $count = count($request->category_id);
        for ($i = 0; $i < $count; $i++) {
            $product_category = new ProductCategory();
            $product_category->product_id = $product->id;
            $product_category->category_id = $request->category_id[$i];
            $product_category->save();
        }

        activity()->log('Tambah Data Product');
        return redirect('/product')->with('status', 'Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Product $product)
    {
        $title = "Produk";
        $category = Category::get();
        $inventory = Inventory::where('product_id', $product->id)->first();
        foreach ($category as $i => $v) {
            $product_category = ProductCategory::where('category_id', $v->id)->where('product_id', $product->id)->get();
            if (count($product_category) != 0) {
                $product_categorys[$i] = $product_category[0]->category_id;
            } else {
                $product_categorys[$i] = 0;
            }
        }
        $view = view('admin.product.edit', compact('title', 'product', 'category', 'product_categorys', 'inventory'));
        $view = $view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'unit' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'min_stock' => 'required',
            'full_stock' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:500',
        ]);

        if ($product->image && $request->file('image') != "") {
            $image_path = public_path() . '/storage/upload/product_image/thumbnail/' . $product->image;
            $image_path2 = public_path() . '/storage/upload/product_image/' . $product->image;
            unlink($image_path);
            unlink($image_path2);
        }

        $product->fill($request->all());

        if ($request->file('image')) {

            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/product_image', $filename);
            $request->file('image')->storeAs('public/upload/product_image/thumbnail', $filename);

            $thumbnailpath = public_path('storage/upload/product_image/thumbnail/' . $filename);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $product->image = $filename;
        }

        $product->purchase_price = str_replace(".", "", $request->purchase_price);
        $product->selling_price = str_replace(".", "", $request->selling_price);
        $product->save();

        $inventory = Inventory::where('product_id', $product->id)->first();
        $inventory = Inventory::find($inventory->id);
        $inventory->min_stock = str_replace(".", "", $request->min_stock);
        $inventory->full_stock = str_replace(".", "", $request->full_stock);
        $inventory->save();

        $product_category = ProductCategory::where('product_id', $product->id)->delete();

        $count = count($request->category_id);
        for ($i = 0; $i < $count; $i++) {
            $product_category = new ProductCategory();
            $product_category->product_id = $product->id;
            $product_category->category_id = $request->category_id[$i];
            $product_category->save();
        }

        activity()->log('Ubah Data Product dengan ID = ' . $product->id);
        return redirect('/product')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Product $product)
    {
        $product->status = 0;
    	$product->save();
        // $product->delete();

        activity()->log('Hapus Data Product dengan ID = ' . $product->id);
        return redirect('/product')->with('status', 'Data Berhasil Dihapus');
    }

    public function print_barcode(Request $request){
		$product_id = $request->product_id;
		$jumlah = count($request->product_id);
		for($i=0;$i<$jumlah;$i++) {
            $product[$i] = Product::find($request->product_id[$i]);
		}
			
        $pdf = PDF::loadview('admin.product.print2',[
            'product_id'=>$request->product_id,
            'product'=>$product
        ]);
        return $pdf->download('barcode.pdf');

        // return view('admin.product.print', compact('product_id','product'));
	}

}
