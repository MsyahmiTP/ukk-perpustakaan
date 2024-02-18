<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->get();
        return view('admin.admin', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
        ]);

        $admin = User::findOrFail($id);
        $admin->update($request->all());

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index');
    }
}
