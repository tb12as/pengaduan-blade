<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'isi_tanggapan' => 'required',
        ]);

        $p_id = $request->pengaduan_id;

        $pengaduan = Pengaduan::findOrFail($p_id);
        $pengaduan->tanggapan()->updateOrCreate(['pengaduan_id' => $p_id], [
            'user_id' => Auth::id(),
            'pengaduan_id' => $p_id,
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return back();
    }
}
