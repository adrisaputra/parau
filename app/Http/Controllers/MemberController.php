<?php

namespace App\Http\Controllers;

use App\Models\Member;   //nama model
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class MemberController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    ## Tampikan Data
    public function index()
    {
        $title = "Member";
        $member = Member::orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.member.index', compact('title', 'member'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Member";
        $member = $request->get('search');
        $member = Member::where(function ($query) use ($member) {
            $query->where('member_name', 'LIKE', '%' . $member . '%')
                ->orWhere('phone', 'LIKE', '%' . $member . '%')
                ->orWhere('address', 'LIKE', '%' . $member . '%');
        })->orderBy('id', 'DESC')->paginate(25)->onEachSide(1);
        return view('admin.member.index', compact('title', 'member'));
    }

    ## Tampilkan Form Create
    public function create()
    {
        $title = "Member";
        $view = view('admin.member.create', compact('title'));
        $view = $view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'member_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $member = new Member();
        $member->member_name = $request->member_name;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->description = $request->description;

        $member->save();

        activity()->log('Tambah Data Member');
        return redirect('/member')->with('status', 'Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Member $member)
    {
        $title = "Member";
        $view = view('admin.member.edit', compact('title', 'member'));
        $view = $view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'member_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $member->fill($request->all());
        $member->save();

        activity()->log('Ubah Data Member dengan ID = ' . $member->id);
        return redirect('/member')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Member $member)
    {
        $member->delete();

        activity()->log('Hapus Data Member dengan ID = ' . $member->id);
        return redirect('/member')->with('status', 'Data Berhasil Dihapus');
    }
}
