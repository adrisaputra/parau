<?php

namespace App\Http\Controllers;

use App\Models\Setting;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    ## Tampikan Data
    public function index()
    {
        $title = 'Setting';
        $setting = Setting::find(1);
        $view = view('admin.setting.edit', compact('title', 'setting'));
        $view = $view->render();
        return $view;
    }


    ## Edit Data
    public function update(Request $request, Setting $setting)
    {
        $this->validate($request, [
            'logo_kecil' => 'mimes:jpg,jpeg,png|max:500',
            'logo_besar' => 'mimes:jpg,jpeg,png|max:500',
            'background_login' => 'mimes:jpg,jpeg,png|max:2000',
            'foto_kepala_dinas' => 'mimes:jpg,jpeg,png|max:500',
        ]);

        if ($request->file('logo_kecil') && $setting->logo_kecil) {
            $pathToYourFile = public_path('upload/setting/' . $setting->logo_kecil);
            if (file_exists($pathToYourFile)) {
                unlink($pathToYourFile);
            }
        }

        if ($request->file('logo_besar') && $setting->logo_besar) {
            $pathToYourFile = public_path('upload/setting/' . $setting->logo_besar);
            if (file_exists($pathToYourFile)) {
                unlink($pathToYourFile);
            }
        }

        if ($request->file('background_login') && $setting->background_login) {
            $pathToYourFile = public_path('upload/setting/' . $setting->background_login);
            if (file_exists($pathToYourFile)) {
                unlink($pathToYourFile);
            }
        }

        if ($request->file('foto_kepala_dinas') && $setting->foto_kepala_dinas) {
            $pathToYourFile = public_path('upload/setting/' . $setting->foto_kepala_dinas);
            if (file_exists($pathToYourFile)) {
                unlink($pathToYourFile);
            }
        }

        $setting->fill($request->all());

        if ($request->file('logo_kecil') == "") {
        } else {
            $filename = time() . '1.' . $request->logo_kecil->getClientOriginalExtension();
            $request->logo_kecil->move(public_path('upload/setting'), $filename);
            $setting->logo_kecil = $filename;
        }

        if ($request->file('logo_besar') == "") {
        } else {
            $filename = time() . '2.' . $request->logo_besar->getClientOriginalExtension();
            $request->logo_besar->move(public_path('upload/setting'), $filename);
            $setting->logo_besar = $filename;
        }

        if ($request->file('background_login') == "") {
        } else {
            $filename = time() . '3.' . $request->background_login->getClientOriginalExtension();
            $request->background_login->move(public_path('upload/setting'), $filename);
            $setting->background_login = $filename;
        }

        if ($request->file('foto_kepala_dinas') == "") {
        } else {
            $filename = time() . '4.' . $request->foto_kepala_dinas->getClientOriginalExtension();
            $request->foto_kepala_dinas->move(public_path('upload/setting'), $filename);
            $setting->foto_kepala_dinas = $filename;
        }

        $setting->user_id = Auth::user()->id;
        $setting->save();

        activity()->log('Ubah Data Setting');
        return redirect('/setting')->with('status', 'Data Berhasil Diubah');
    }
}
