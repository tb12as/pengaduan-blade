<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasyarakatStoreRequest;
use App\Http\Requests\PetugasStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user_management', compact('users'));
    }

    public function create_petugas()
    {
    	return view('admin.petugas_create');
    }

    public function create_masyarakat()
    {
    	return view('admin.masyarakat_create');
    }

    public function petugas_store(PetugasStoreRequest $request)
    {
    	$d = User::create($request->validated());
    	$d->attachRole('petugas');

        session()->flash('success', 'Petugas berhasil ditambahkan');

    	return redirect()->route('userman.index');

    }

    public function masyarakat_store(MasyarakatStoreRequest $request)
    {
        $d = User::create($request->validated());
        $d->attachRole('masyarakat');

        session()->flash('success', 'Masyarakat berhasil ditambahkan');

        return redirect()->route('userman.index');

    }

    public function destroy(User $user)
    {
    	$user->delete();
    	return redirect()->back()->with(['success' => 'User berhasil dihapus']);
    }
}
