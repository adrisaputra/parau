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

class ProjectController extends Controller
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
            ->where('status',1)->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

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

        $project = Project::where('outlet_id', Auth::user()->outlet_id)->where('status',1)->orderBy('id', 'DESC');
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

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Project";
        $lat = "-3.974809556959808";
        $long = "122.51639499313075";
        $view = view('admin.project.create', compact('title', 'lat', 'long'));
        $view = $view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
        ]);

        $project = Project::whereDate('created_at', Carbon::today())->count();
        $input['project_name'] =  'project-'.date('dmY').$project+1;
        $input['client_name'] = $request->client_name;
        $input['phone'] = $request->phone;
        $input['address'] = $request->address;
        $input['lat'] = $request->lat;
        $input['long'] = $request->long;
        $input['outlet_id'] = Auth::user()->outlet_id;

        Project::create($input);

        activity()->log('Tambah Data Project');
        return redirect('/project')->with('status', 'Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Project $project)
    {
        $title = "Project";
        $view = view('admin.project.edit', compact('title', 'project'));
        $view = $view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'client_name' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
        ]);

        $project->fill($request->all());
        $project->save();

        activity()->log('Ubah Data Project dengan ID = ' . $project->id);
        return redirect('/project')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Project $project)
    {
        $project->status = 0;
        $project->save();

        activity()->log('Hapus Data Project dengan ID = ' . $project->id);
        return redirect('/project')->with('status', 'Data Berhasil Diarsipkan');
    }


    ## Invoice
    public function invoice(Request $request)
    {
        $id = $request->project_id;
        $project = Project::find($id);
        $material = Material::where('project_id', $id)->get();
        
        if($request->invoice==1){

            $pdf = PDF::loadview('admin.invoice.client',[
                        'project'=>$project
                    ])->setPaper('a4', 'landscape');
            return $pdf->download('INVOICE CLIENT.pdf');
            // return view('admin.invoice.client', compact('project'));
        } else if($request->invoice==2){

            $pdf = PDF::loadview('admin.invoice.worker',[
                        'project'=>$project
                    ])->setPaper('a4', 'protait');
            return $pdf->download('INVOICE PEMBAYARAN TUKANG.pdf');

        } else if($request->invoice==3){

            $pdf = PDF::loadview('admin.invoice.material',[
                        'material'=>$material
                    ])->setPaper('a4', 'protait');
            return $pdf->download('INVOICE PEMBELIAN MATERIAL.pdf');

        }
    }

}
