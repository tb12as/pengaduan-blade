<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class CetakController extends Controller
{
    public function cetak($slug)
    {
        $data = Pengaduan::with(['user', 'tanggapan' => fn($q) => $q->with('user')])->where('slug', $slug)->firstOrFail();

        $file = PDF::loadView('admin.cetak.pengaduan', compact('data'));
        return $file->stream($data->slug. '.pdf');
    }
}
