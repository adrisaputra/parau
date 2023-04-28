<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;   //nama model
use App\Models\Outlet;   //nama model
use App\Models\Project;   //nama model
use App\Models\ProjectDetail;   //nama model
use App\Models\Product;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        $outlet = Outlet::find(Auth::user()->outlet_id);
        $total_project = ProjectDetail::whereHas('project', function ($query) {
                                $query->where('outlet_id', Auth::user()->outlet_id);
                        })->count();
        $on_list = ProjectDetail::where('status','ON LIST')
                    ->whereHas('project', function ($query) {
                            $query->where('outlet_id', Auth::user()->outlet_id);
                    })->count();
        $on_progress = ProjectDetail::where('status','ON PROGRESS')->whereHas('project', function ($query) {
                                $query->where('outlet_id', Auth::user()->outlet_id);
                        })->count();
        $done = ProjectDetail::where('status','DONE')->whereHas('project', function ($query) {
                        $query->where('outlet_id', Auth::user()->outlet_id);
                })->count();
        $project = Project::where('outlet_id',Auth::user()->outlet_id)->whereHas('project_detail', function ($query) {
                            $query->where('status', 'ON PROGRESS');
                    })->get();
        $product = Product::where('outlet_id',Auth::user()->outlet_id)->whereHas('inventory', function ($query) {
                            $query->where('in_stock','<=', 30);
                    })->get();

        return view('admin.beranda', compact('outlet','project','total_project','on_list','on_progress','done','product'));
       
    }

    
    public function detail_peta(Project $project)
    {
        $project_detail = ProjectDetail::where('project_id',$project->id)->get();
		return view('admin.detail_peta',compact('project','project_detail'));
    }
}
