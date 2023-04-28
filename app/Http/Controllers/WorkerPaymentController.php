<?php

namespace App\Http\Controllers;

use App\Models\Team;   //nama model
use App\Models\Worker;   //nama model
use App\Models\WorkerPayment;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class WorkerPaymentController extends Controller
{
     ## Cek Login
     public function __construct()
     {
         $this->middleware('auth');
     }
     
    ## Tampikan Data
    public function index($team, $worker)
    {
        $title = "Pembayaran Aplicator";
        $team = Team::where('id',$team)->first();
        $worker = Worker::where('id',$worker)->first();
        $worker_payment = WorkerPayment::where('worker_id',$worker->id)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.worker_payment.index',compact('title','team','worker','worker_payment'));
    }

	## Tampilkan Data Search
	public function search($team, $worker, Request $request)
    {
        $title = "Pembayaran Aplicator";
        $team = Team::where('id',$team)->first();
        $worker = Worker::where('id',$worker)->first();
        $worker_payment = $request->get('search');
        $worker_payment = WorkerPayment::where('worker_id',$worker->id)->where('desc', 'LIKE', '%'.$worker_payment.'%')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.worker_payment.index',compact('title','team','worker','worker_payment'));
    }

    ## Tampilkan Form Create
    public function create($team, $worker)
    {
        $title = "Pembayaran Aplicator";
        $team = Team::where('id',$team)->first();
        $worker = Worker::where('id',$worker)->first();
		$view=view('admin.worker_payment.create',compact('title','team','worker'));
        $view=$view->render();
        return $view;
    }
	
    ## Simpan Data
    public function store($team, $worker, Request $request)
    {
        $this->validate($request, [
            'down_payment' => 'required',
            'date' => 'required'
        ]);

		$input['worker_id'] = $worker;
		$input['desc'] = $request->desc;
		$input['down_payment'] = str_replace(".", "", $request->down_payment);
        $d = substr($request->date,0,2);
        $m = substr($request->date,3,2);
        $y = substr($request->date,6,4);
        $input['date'] = $y.'-'.$m.'-'.$d;
        WorkerPayment::create($input);
        
        activity()->log('Tambah Data Pembayaran Aplicator');
		return redirect('/worker_payment/'.$team.'/'.$worker)->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($team, $worker, WorkerPayment $worker_payment)
    {
        $title = "Pembayaran Aplicator";
        $team = Team::where('id',$team)->first();
        $worker = Worker::where('id',$worker)->first();
		$view=view('admin.worker_payment.edit',compact('title','team','worker','worker_payment'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $team, $worker, WorkerPayment $worker_payment)
    {
        $this->validate($request, [
            'down_payment' => 'required',
            'date' => 'required'
        ]);

        $worker_payment->fill($request->all());
        $worker_payment->down_payment = str_replace(".", "", $request->down_payment);
    	$worker_payment->save();
        
        activity()->log('Ubah Data Worker Payment dengan ID = '.$worker_payment->id);
		return redirect('/worker_payment/'.$team.'/'.$worker)->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($team, $worker, WorkerPayment $worker_payment)
    {

        $worker_payment->delete();

        activity()->log('Hapus Data Payment dengan ID = '.$worker_payment->id);
        return redirect('/worker_payment/'.$team.'/'.$worker)->with('status', 'Data Berhasil Dihapus');
    }

}
