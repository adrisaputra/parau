<?php

namespace App\Http\Controllers;

use App\Models\Product;   //nama model
use App\Models\Inventory;   //nama model
use App\Models\Project;   //nama model
use App\Models\ProjectDetail;   //nama model
use App\Models\Material;   //nama model
use App\Models\Payment;   //nama model
use App\Models\Outlet;   //nama model
use App\Models\SellingDetail;
use App\Models\SellingTransaction;
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index($project)
    {
        $title = "Pembayaran";
        $project_detail = ProjectDetail::select(DB::raw('SUM(service_value * volume) as service_value'))->where('project_id',$project)->first();
        $project = Project::where('id',$project)->first();

        $sum_payment = Payment::where('project_id',$project_detail->project_id)->sum('down_payment');

        return view('admin.payment.index',compact('title','project','project_detail','sum_payment'));
    }

    ## Tampikan Data
    public function index2($project)
    {
        $title = "Pembayaran";
        $project_detail = ProjectDetail::select(DB::raw('SUM(service_value * volume) as service_value'))->where('project_id',$project)->first();
        $project = Project::where('id',$project)->first();

        $payment = Payment::where('project_id',$project->id)->orderBy('id','ASC')->get();
        $sum_payment = Payment::where('project_id',$project->id)->sum('down_payment');

        return view('admin.payment.index2',compact('title','project','project_detail','payment','sum_payment'));
    }

    ## Tampilkan Form Create
    public function create($project)
    {
        $title = "Pembayaran";
        $project = Project::where('id',$project)->first();
        $project_detail = ProjectDetail::select(DB::raw('SUM(service_value * volume) as service_value'))->where('project_id',$project->id)->first();
        $payment = Payment::where('project_id',$project->id)->get();
        $sum_payment = Payment::where('project_id',$project->id)->sum('down_payment');
		$view=view('admin.payment.create',compact('title','project','project_detail','payment','sum_payment'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store($project, Request $request)
    {

        $this->validate($request, [
            'down_payment' => 'required'
        ]);

        $input['project_id'] = $project;
        $input['desc'] = $request->desc;
        $input['down_payment'] = str_replace(".", "", $request->down_payment);
        $d = substr($request->date,0,2);
        $m = substr($request->date,3,2);
        $y = substr($request->date,6,4);
        $input['date'] = $y.'-'.$m.'-'.$d;
        
        Payment::create($input);
    
        activity()->log('Tambah Data pembayaran');
		return redirect('/payment2/'.$project)->with('status','Data Tersimpan');
    }
    
    ## Tampilkan Form Edit
    public function edit($project, Payment $payment)
    {
        $title = "Pembayaran";
        $project = Project::where('id',$project)->first();
        $view=view('admin.payment.edit', compact('title','project','payment'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $project, Payment $payment)
    {
        $this->validate($request, [
            'down_payment' => 'required',
        ]);

        $payment->fill($request->all());
        
        $payment->down_payment = str_replace(".", "", $request->down_payment);
        $d = substr($request->date,0,2);
        $m = substr($request->date,3,2);
        $y = substr($request->date,6,4);
        $payment->date = $y.'-'.$m.'-'.$d;

    	$payment->save();
		
        activity()->log('Ubah Data Payment dengan ID = '.$payment->id);
		return redirect('/payment2/'.$project)->with('status', 'Data Berhasil Diubah');
    }

    ## Discount Data
    public function discount(Request $request, Project $project)
    {

        $project->discount = str_replace(".", "", $request->discount);
        $project->save();

        activity()->log('Beri Diskon Data Project dengan ID = ' . $project->id);
		return redirect('/payment/'.$project->id)->with('status', 'Data Berhasil Diubah');
    }

     ## Hapus Data
    public function delete($project, Payment $payment)
    {

    	$payment->delete();

        activity()->log('Hapus Data Payment dengan ID = '.$payment->id);
        return redirect('/payment2/'.$project)->with('status', 'Data Berhasil Dihapus');
    }

}
