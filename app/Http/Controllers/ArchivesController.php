<?php

namespace App\Http\Controllers;

use App\Models\Project;   //nama model
use App\Models\ProjectDetail;   //nama model
use App\Models\Material;   //nama model
use App\Models\Payment;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PDF;

class ArchivesController extends Controller
{
     ## Cek Login
     public function __construct()
     {
         $this->middleware('auth');
     }
 
     ## Tampikan Data
     public function index()
     {
        $title = "Project";
        $project = Project::where('outlet_id', Auth::user()->outlet_id)
            ->where('status',0)->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        $project_detail = NULL;
        $sum_payment = NULL;
        foreach($project as $i => $v){
            $project_detail[$i] = ProjectDetail::select(DB::raw('SUM(service_value * volume) as service_value'))->where('project_id',$v->id)->first();
            $sum_payment[$i] = Payment::where('project_id',$v->id)->sum('down_payment');
        }

        return view('admin.project.index', compact('title', 'project','project_detail','sum_payment'));
     }
 
     ## Tampilkan Data Search
     public function search(Request $request)
     {
         $title = "Project";
         $search = $request->get('search');
         $work_date = $request->get('work_date');
         $d = substr($request->get('work_date'),0,2);
         $m = substr($request->get('work_date'),3,2);
         $y = substr($request->get('work_date'),6,4);
         $date = $y.'-'.$m.'-'.$d;
         $status = $request->get('status');
 
         $project = Project::where('outlet_id', Auth::user()->outlet_id)->where('status',0)->orderBy('id', 'DESC');
         if($search){
             $project = $project->where(function ($query) use ($search) {
                 $query->where('project_name', 'LIKE', '%' . $search . '%')
                 ->orWhere('client_name', 'LIKE', '%' . $search . '%')
                 ->orWhere('phone', 'LIKE', '%' . $search . '%')
                 ->orWhere('address', 'LIKE', '%' . $search . '%');
             });
         }
         if($work_date){
             $project = $project->whereHas('project_detail', function ($query) use ($work_date,$date) {
                     $query->whereDate('work_start', '<=', $date)
                         ->WhereDate('work_end', '>=', $date);
             });
         }
         if($status){
             $project = $project->whereHas('project_detail', function ($query) use ($status) {
                     $query->where('status', $status);
             });
         }
         $project = $project->paginate(25)->onEachSide(1);
     
         $project_detail = NULL;
         $sum_payment = NULL;
         foreach($project as $i => $v){
             $project_detail[$i] = ProjectDetail::select(DB::raw('SUM(service_value * volume) as service_value'))->where('project_id',$v->id)->first();
             $sum_payment[$i] = Payment::where('project_id',$v->id)->sum('down_payment');
         }
 
         return view('admin.project.index', compact('title', 'project','project_detail','sum_payment'));
     }

     
    ## Hapus Data
    public function restore_data(Project $project)
    {
        $project->status = 1;
        $project->save();

        activity()->log('Kembalikan Data Project dengan ID = ' . $project->id);
        return redirect('/archives')->with('status', 'Data Berhasil Dikembalikan');
    }

 
}
