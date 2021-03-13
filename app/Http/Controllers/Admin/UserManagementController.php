<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasStoreRequest;
use App\Http\Requests\PetugasUpdateRequest;
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

    public function petugas_store(PetugasStoreRequest $request)
    {
    	$d = User::create($request->validated());
    	$d->attachRole('petugas');

        session()->flash('success', 'Petugas berhasil ditambahkan');

    	return redirect()->route('userman.index');
    }

    public function petugas_edit(User $user)
    {
        return view('admin.petugas_edit', compact('user'));
    }

    public function petugas_update(PetugasUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $data['password'] = $request->password ? bcrypt($request->password) : $user->password;

        $user->update($data);

        session()->flash('success', 'Data petugas berhasil diupdate');

    	return redirect()->route('userman.index');
    }

    public function destroy(User $user)
    {
    	$user->delete();
    	return redirect()->back()->with(['success' => 'User berhasil dihapus']);
    }
}
