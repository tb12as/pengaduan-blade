<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasyarkatController extends Controller
{
    public function index()
    {
        $data = Pengaduan::where('user_id', Auth::id())->latest()->get();
        return view('masyarakat.pengaduan', compact('data'));
    }
}
