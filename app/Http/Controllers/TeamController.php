<?php

namespace App\Http\Controllers;

use App\Models\Team;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Tim";
        $team = Team::where('outlet_id', Auth::user()->outlet_id)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.team.index',compact('title','team'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Tim";
        $team = $request->get('search');
        $team = Team::where('outlet_id', Auth::user()->outlet_id)->where('team_name', 'LIKE', '%'.$team.'%')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.team.index',compact('title','team'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Tim";
		$view=view('admin.team.create',compact('title'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'team_name' => 'required'
        ]);

        $input['outlet_id'] = Auth::user()->outlet_id;
		$input['team_name'] = $request->team_name;
		$input['description'] = $request->description;
		// $input['user_id'] = Auth::user()->id;
		
        Team::create($input);
        
        activity()->log('Tambah Data Tim');
		return redirect('/team')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Team $team)
    {
        $title = "Tim";
        $view=view('admin.team.edit', compact('title','team'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Team $team)
    {
        $this->validate($request, [
            'team_name' => 'required'
        ]);

        $team->fill($request->all());
    	$team->save();
		
        activity()->log('Ubah Data Team dengan ID = '.$team->id);
		return redirect('/team')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Team $team)
    {
    	$team->delete();

        activity()->log('Hapus Data Team dengan ID = '.$team->id);
        return redirect('/team')->with('status', 'Data Berhasil Dihapus');
    }
}
