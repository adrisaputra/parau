<?php

namespace App\Helpers;

use App\Models\Menu;   //nama model
use App\Models\SubMenu;   //nama model
use App\Models\MenuAccess;   //nama model
use App\Models\SubMenuAccess;   //nama model
use Illuminate\Support\Facades\Auth;

class SiteHelpers
{
    
    public static function config_menu()
    {
        $menu = MenuAccess::leftJoin('group_tbl', 'menu_access_tbl.group_id', '=', 'group_tbl.id')
                ->leftJoin('menu_tbl', 'menu_access_tbl.menu_id', '=', 'menu_tbl.id')
                ->where('menu_access_tbl.group_id',Auth::user()->group_id)
                ->where('menu_tbl.status',1)
                ->where('menu_tbl.category',1)
                ->orderBy('menu_tbl.position','ASC')
                ->get();
        return $menu;
    }

    public static function main_menu()
    {
        $menu = MenuAccess::leftJoin('group_tbl', 'menu_access_tbl.group_id', '=', 'group_tbl.id')
                ->leftJoin('menu_tbl', 'menu_access_tbl.menu_id', '=', 'menu_tbl.id')
                ->where('menu_access_tbl.group_id',Auth::user()->group_id)
                ->where('menu_tbl.status',1)
                ->where('menu_tbl.category',2)
                ->orderBy('menu_tbl.position','ASC')
                ->get();
        return $menu;
    }

    public static function submenu($menu_id)
    {
        $submenu = SubMenuAccess::leftJoin('group_tbl', 'sub_menu_access_tbl.group_id', '=', 'group_tbl.id')
                    ->leftJoin('sub_menu_tbl', 'sub_menu_access_tbl.sub_menu_id', '=', 'sub_menu_tbl.id')
                    ->where('sub_menu_access_tbl.group_id',Auth::user()->group_id)
                    ->where('sub_menu_tbl.status',1)
                    ->where('sub_menu_tbl.menu_id',$menu_id)
                    ->orderBy('position','ASC')->get();
        return $submenu;
    }

}
