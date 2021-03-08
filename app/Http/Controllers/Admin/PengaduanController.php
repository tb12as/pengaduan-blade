<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::with('user')->get();
        return view('admin.pengaduan_index', compact('data'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan_detail', compact('pengaduan'));
    }

    public function valid(Pengaduan $pengaduan)
    {
        $pengaduan->status = 'proses';
        $pengaduan->save();


        return back();
    }
}
