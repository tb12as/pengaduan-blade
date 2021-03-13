<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengaduanRequest;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('masyarakat.pengaduan_create');
    }

    public function store(PengaduanRequest $request)
    {
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $ex = $file->getClientOriginalExtension();

            $namaFile = Str::random(20).".$ex";

            $file->move(public_path()."/foto_pengaduan/", $namaFile);

            $namaFileFinal = "/foto_pengaduan/$namaFile";
        }

        Pengaduan::create([
            'user_id' => Auth::id(),
            'isi_laporan' => $request->isi_laporan,
            'slug' => Str::slug('laporan-masyarakat-'.Str::random(20)),
            'foto' => $namaFileFinal ?? null,
        ]);

        return redirect()->route('masyarakat.index');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('masyarakat.pengaduan_detail', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('masyarakat.pengaduan_edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($request->hasFile('foto')) {
            if ($foto = $pengaduan->foto) {
                \File::delete($foto);
            }

            $file = $request->file('foto');
            $ex = $file->getClientOriginalExtension();

            $namaFile = Str::random(20).".$ex";

            $file->move(public_path()."/foto_pengaduan/", $namaFile);

            $namaFileFinal = "/foto_pengaduan/$namaFile";
        }

        $pengaduan->update([
            'isi_laporan' => $request->isi_laporan,
            'foto' => $namaFileFinal ?? $pengaduan->foto,
        ]);

        return redirect()->route('masyarakat.index');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($foto = $pengaduan->foto) {
            \File::delete($foto);
        }

        $pengaduan->delete();
        return back();

    }
}
