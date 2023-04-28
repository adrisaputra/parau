<?php

namespace App\Http\Controllers;

use App\Models\Project;   //nama model
use App\Models\ProjectDetail;   //nama model
use App\Models\Team;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Image;

class ProjectDetailController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index($id)
    {
        $title = "Detail Project";
        $project = Project::where('id',$id)->first();
        $project_detail = ProjectDetail::where('project_id',$id)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.project_detail.index',compact('title','project','project_detail'));
    }

	## Tampilkan Data Search
	public function search($id, Request $request)
    {
        $title = "Detail Project";
        $project = Project::where('id',$id)->first();
        $project_detail = $request->get('search');
        $project_detail = ProjectDetail::where('project_id',$id)
                        ->where(function ($query) use ($project_detail) {
                            $query->where('work_name', 'LIKE', '%'.$project_detail.'%')
                            ->orWhere('work_date', 'LIKE', '%'.$project_detail.'%')
                            ->orWhere('estimation', 'LIKE', '%'.$project_detail.'%')
                            ->orWhere('team', 'LIKE', '%'.$project_detail.'%');
                        })
                        ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.project_detail.index',compact('title','project','project_detail'));
    }
	
    ## Tampilkan Form Create
    public function create($id)
    {
        $title = "Detail Project";
        $project = Project::where('id',$id)->first();
        $team = Team::where('outlet_id', Auth::user()->outlet_id)->get();
		$view=view('admin.project_detail.create',compact('title','project','team'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store($id, Request $request)
    {
        $this->validate($request, [
            'work_name' => 'required',
            'service_value' => 'required',
            'volume' => 'required',
            'work_start' => 'required',
            'work_end' => 'required',
            'team_id' => 'required',
        ]);

		$input['project_id'] = $id;
		$input['work_name'] = $request->work_name;
		$input['description'] = $request->description;
		$input['service_value'] = str_replace(".", "", $request->service_value);
		$input['volume'] = $request->volume;
        
		if($request->file('image')){
            $input['image'] = time().'.'.$request->file('image')->getClientOriginalExtension();
 
            // $request->file('image')->storeAs('public/upload/project_image', $input['image']);
            $request->file('image')->storeAs('public/upload/project_image/thumbnail', $input['image']);
     
            $thumbnailpath = public_path('storage/upload/project_image/thumbnail/'.$input['image']);
            $img = Image::make($thumbnailpath)->resize(1300, 1000, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }

        $start_d = substr($request->work_start,0,2);
        $start_m = substr($request->work_start,3,2);
        $start_y = substr($request->work_start,6,4);
        $input['work_start'] = $start_y.'-'.$start_m.'-'.$start_d;

        $end_d = substr($request->work_end,0,2);
        $end_m = substr($request->work_end,3,2);
        $end_y = substr($request->work_end,6,4);
        $input['work_end'] = $end_y.'-'.$end_m.'-'.$end_d;

		$input['estimation'] = $request->estimation;
		$input['team_id'] = $request->team_id;

        ProjectDetail::create($input);
        
        activity()->log('Tambah Data Project Detail');
		return redirect('/project-detail/'.$id)->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($id, ProjectDetail $project_detail)
    {
        $title = "Detail Project";
        $project = Project::where('id',$id)->first();
        $team = Team::where('outlet_id', Auth::user()->outlet_id)->get();
        $view=view('admin.project_detail.edit', compact('title','project','project_detail','team'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $id, ProjectDetail $project_detail)
    {
        $this->validate($request, [
            'work_name' => 'required',
            'service_value' => 'required',
            'volume' => 'required',
			// 'image' => 'mimes:jpg,jpeg,png|max:500',
            'work_start' => 'required',
            'work_end' => 'required',
            'team_id' => 'required',
        ]);

        if($project_detail->image && $request->file('image')!=""){
            $image_path = public_path().'/storage/upload/project_image/thumbnail/'.$project_detail->image;
            // $image_path2 = public_path().'/storage/upload/project_image/'.$project_detail->image;
            unlink($image_path);
            // unlink($image_path2);
        }

        $project_detail->fill($request->all());
        
		$project_detail->service_value = str_replace(".", "", $request->service_value);
        
		if($request->file('image')){

            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
           
            // $request->file('image')->storeAs('public/upload/project_image', $filename);
            $request->file('image')->storeAs('public/upload/project_image/thumbnail', $filename);
     
            $thumbnailpath = public_path('storage/upload/project_image/thumbnail/'.$filename);
            $img = Image::make($thumbnailpath)->resize(1300, 1000, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $project_detail->image = $filename;
        }
        
        $start_d = substr($request->work_start,0,2);
        $start_m = substr($request->work_start,3,2);
        $start_y = substr($request->work_start,6,4);
        $project_detail->work_start = $start_y.'-'.$start_m.'-'.$start_d;

        $end_d = substr($request->work_end,0,2);
        $end_m = substr($request->work_end,3,2);
        $end_y = substr($request->work_end,6,4);
        $project_detail->work_end = $end_y.'-'.$end_m.'-'.$end_d;

        $formatted_dt1=Carbon::parse($project_detail->work_start);
        $formatted_dt2=Carbon::parse($project_detail->work_end);
        $project_detail->estimation = $formatted_dt1->diffInDays($formatted_dt2)+1;
        
    	$project_detail->save();
        
        activity()->log('Ubah Data Project Detail dengan ID = '.$project_detail->id);
		return redirect('/project-detail/'.$id)->with('status', 'Data Berhasil Diubah');


    }

    ## Edit Data
    public function update_status(Request $request, $id, ProjectDetail $project_detail)
    {
        $project_detail->fill($request->all());
    	$project_detail->save();
        
        activity()->log('Ubah Status Project Detail dengan ID = '.$project_detail->id);
		return redirect('/project-detail/'.$id)->with('status', 'Status Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($id, ProjectDetail $project_detail)
    {
    	$project_detail->delete();

        activity()->log('Hapus Data Project Detail dengan ID = '.$project_detail->id);
        return redirect('/project-detail/'.$id)->with('status', 'Data Berhasil Dihapus');
    }
}
