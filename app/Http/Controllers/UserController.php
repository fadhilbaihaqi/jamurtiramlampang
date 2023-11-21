<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $kelolauser = User::all();
        return view('kelolauser.index', compact('roles', 'kelolauser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);
        try {
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);
            return redirect()->route('kelolauser.index')->with('success', 'Data berhasil disimpan');
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('kelolauser.index')->with('catch', 'Data harus diisi');
        }
    }

    public function update(Request $request, $id)
    {
        $validasi = [
            'username' => 'required',
            'role_id' => 'required',
        ];
        if ($request->password) {
            $validasi["password"] = 'required';
        }
        $request->validate($validasi);

        try {
            $data = [
                'username' => $request->username,
                'role_id' => $request->role_id,
            ];
            if ($request->password) {
                $data["password"] = Hash::make($request->password);
            }
            User::where('id', $id)->update($data);
            return redirect()->route('kelolauser.index')->with('success', 'Data berhasil diubah');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('kelolauser.index')->with('catch', 'Data harus diisi');
        }
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
            return redirect()->route('kelolauser.index')->with('success', 'Data berhasil dihapus');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('kelolauser.index')->with('catch', 'Data harus diisi');
        }
    }
}
