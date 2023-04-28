<?php

namespace App\Http\Controllers;

use App\Models\Team;   //nama model
use App\Models\Worker;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index($id)
    {
        $title = "Aplicator";
        $team = Team::where('id',$id)->first();
        $worker = Worker::where('team_id',$id)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.worker.index',compact('title','team','worker'));
    }

    ## Tampilkan Form Create
    public function create($id)
    {
        $title = "Aplicator";
        $team = Team::where('id',$id)->first();
		$view=view('admin.worker.create',compact('title','team'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store($id, Request $request)
    {
        $this->validate($request, [
            'worker_name' => 'required',
            'salary' => 'required'
        ]);

		$input['team_id'] = $id;
		$input['worker_name'] = $request->worker_name;
		$input['salary'] = str_replace(".", "", $request->salary);
        Worker::create($input);
        
        activity()->log('Tambah Data Worker');
		return redirect('/worker/'.$id)->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($id, Worker $worker)
    {
        $title = "Aplicator";
        $team = Team::where('id',$id)->first();
        $view=view('admin.worker.edit', compact('title','team','worker'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $id, Worker $worker)
    {
        $this->validate($request, [
            'worker_name' => 'required',
            'salary' => 'required'
        ]);

        $worker->fill($request->all());
		$worker->salary = str_replace(".", "", $request->salary);
    	$worker->save();
        
        activity()->log('Ubah Data Worker dengan ID = '.$worker->id);
		return redirect('/worker/'.$id)->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($id, Worker $worker)
    {
    	$worker->delete();

        activity()->log('Hapus Data Worker dengan ID = '.$worker->id);
        return redirect('/worker/'.$id)->with('status', 'Data Berhasil Dihapus');
    }

}
