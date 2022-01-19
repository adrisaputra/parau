<?php

namespace App\Http\Middleware;

use App\Models\User;   //nama model
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $count_menu  = User::leftJoin('menu_access_tbl', 'menu_access_tbl.group_id', '=', 'users.group_id')
                        ->leftJoin('menu_tbl', 'menu_access_tbl.menu_id', '=', 'menu_tbl.id')
                        ->where('users.id',Auth::user()->id)
                        ->where('menu_tbl.link',request()->segment(1))
                        ->count();
        $count_sub_menu  = User::leftJoin('sub_menu_access_tbl', 'sub_menu_access_tbl.group_id', '=', 'users.group_id')
                        ->leftJoin('sub_menu_tbl', 'sub_menu_access_tbl.sub_menu_id', '=', 'sub_menu_tbl.id')
                        ->where('users.id',Auth::user()->id)
                        ->where('sub_menu_tbl.link',request()->segment(1))
                        ->count();

        if($count_menu==0 && $count_sub_menu==0 ){
            return redirect('dashboard');
        }

        return $next($request);
    }
}
