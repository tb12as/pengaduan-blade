<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting');
    }

    public function store(Request $request, User $user)
    {
        if ($user->hasRole(['admin', 'petugas'])) {
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'username' => [
                    'required',
                    'string',
                    'max:50',
                    'min:4',
                    Rule::unique('users', 'username')->ignore($user->id),
                ],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
                'password' => ['nullable', 'string', 'min:8', 'confirmed']
            ]);
        } else {
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'numeric', 'digits:16', Rule::unique('users', 'nik')->ignore($user->id)],
                'telp' => ['required', 'numeric', 'digits_between:11,14'],
                'username' => [
                    'required',
                    'string',
                    'max:50',
                    'min:4',
                    Rule::unique('users', 'username')->ignore($user->id),
                ],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id),],
                'password' => ['nullable', 'string', 'min:8', 'confirmed']
            ]);
        }

        $data['password'] = $request->password ? bcrypt($request->password) : $user->password;

        $user->update($data);

        session()->flash('success', 'Setting updated');

        return redirect()->route('home');
    }
}
