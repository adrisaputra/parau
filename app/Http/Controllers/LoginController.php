<?php

namespace App\Http\Controllers;

use App\Models\User;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $request){

        $remember_me = $request->has('remember_me') ? true : false; 
        $user = User::where('name', $request->name)->first();

        if ($user && \Hash::check($request->password, $user->password) && $user->status == 1) {
            if (Auth::attempt(['name' => $request->name, 'password' => $request->password],  $remember_me)) {
                // Jika berhasil login
                $user = Auth::user();
                activity()->log('Login');
                return redirect('/dashboard');
            } 
        } else if ($user && \Hash::check($request->password, $user->password) && $user->status == 0) {
            return redirect('/')->with('status','User Tidak Aktif, Silahkan Hubungi Admin !');
        } else {
            return redirect('/')->with('status','Nama User atau Password Tidak Sesuai !');
        }

    }

    public function logout(Request $request)
    {
       activity()->log('Log Out');
       Auth::logout();
       Session::flush();
       return redirect('login')->withSuccess('Terimakasih, selamat datang kembali!');
    }
}
