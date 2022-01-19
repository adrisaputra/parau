<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKepangkatan;   //nama model
use App\Models\RiwayatCuti;   //nama model
use App\Models\Jabatan;   //nama model
use App\Models\Bidang;   //nama model
use App\Models\Pegawai;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class RekapitulasiController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rekapitulasi_jumlah_pegawai()
    {
        $title = "Rekapitulasi Jumlah Pegawai";
        $pria = Pegawai::where('jenis_kelamin','Pria')->where('status_hapus',0)->count();
        $wanita = Pegawai::where('jenis_kelamin','Wanita')->where('status_hapus',0)->count();
        $jumlah_pegawai = Pegawai::where('status_hapus',0)->count();
        return view('admin.rekapitulasi.jumlah_pegawai',compact('title','pria','wanita','jumlah_pegawai'));
    }
    
}
