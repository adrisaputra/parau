<?php

namespace App\Http\Controllers;

use App\Models\Category;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class CategoryController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Kategori";
        $category = Category::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.category.index',compact('title','category'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Kategori";
        $category = $request->get('search');
        $category = Category::where('category_name', 'LIKE', '%'.$category.'%')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.category.index',compact('title','category'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Kategori";
		$view=view('admin.category.create',compact('title'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

		$input['category_name'] = $request->category_name;
		$input['user_id'] = Auth::user()->id;
		
        Category::create($input);
        
        activity()->log('Tambah Data Category');
		return redirect('/category')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Category $category)
    {
        $title = "Kategori";
        $view=view('admin.category.edit', compact('title','category'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

        $category->fill($request->all());
    	$category->save();
		
        activity()->log('Ubah Data Category dengan ID = '.$category->id);
		return redirect('/category')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Category $category)
    {
    	$category->delete();

        activity()->log('Hapus Data Category dengan ID = '.$category->id);
        return redirect('/category')->with('status', 'Data Berhasil Dihapus');
    }
}
