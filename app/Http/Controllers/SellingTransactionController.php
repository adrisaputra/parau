<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellingDetail;
use App\Models\SellingTransaction;
use App\Models\Member;
use App\Models\Inventory;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SellingTransactionController extends Controller
{
    public function index()
    {
        $title = "Riwayat Penjualan";
        $member = Member::all();
        $sellingTransaction =  SellingTransaction::whereHas('user', function ($q) {
            $q->where('outlet_id', Auth::user()->outlet_id);
        })
            ->where("status", 'DONE')->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/selling/index', compact('title', 'sellingTransaction', 'member'));
    }

    public function search(Request $request)
    {
        $title = "Riwayat Penjualan";
        $member = Member::all();
        $search = $request->get('search');
        $sellingTransaction = SellingTransaction::whereHas('user', function ($q) {
            $q->where('outlet_id', Auth::user()->outlet_id);
        })->where("status", 'DONE')
            ->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('transaction_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('pay_cost', 'LIKE', '%' . $search . '%')
                        ->orWhere('total_price', 'LIKE', '%' . $search . '%')
                        ->orWhere('transaction_date', 'LIKE', '%' . $search . '%');
                })
                    ->orwhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('member', function ($query) use ($search) {
                        $query->where('member_name', 'LIKE', '%' . $search . '%');
                    });
            })->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);

        return view('admin/selling/index', compact('title', 'sellingTransaction', 'member'));
    }

    ## Detail Form View
    public function detail($id)
    {
        $title = "Detail Penjualan";
        $sellingTransaction = SellingTransaction::find($id);
        $sellingDetail = SellingDetail::with('product')->where('selling_transaction_id', $id)->get();
        // dd($sellingDetail);
        $view = view('admin.selling.detail', compact('title', 'sellingDetail', 'sellingTransaction'));
        $view = $view->render();
        return $view;
    }
}
