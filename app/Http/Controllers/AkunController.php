<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AkunController extends Controller
{
    public function index()
    {
        $akun = User::all();
        return view('akun.index', compact('akun'));
    }

    public function create()
    {
        return view('akun.create');
    }

    public function store(Request $request)
    {
        try {
            $validasiData = $request->validate([
                // 'nik' => 'required',
                'name' => 'required|string|max:255',
                // 'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|max:20',
                'role' => 'required|string|max:255',
            ]);
    
            $validasiData['password'] = Hash::make($validasiData['password']);
    
            User::create($validasiData);
    
            return redirect('/akun')->with('status', 'Data berhasil ditambah.');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                         ->withInput();
        }
    }
    

    public function edit($id)
    {
        $akun = User::where('id', $id)->get();

        return view('akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = User::findOrFail($id);
    
        $validasiData = $request->validate([
            // 'nik' => ['required', Rule::unique('users')->ignore($akun->id)],
            'name' => 'required|string|max:255',
            // 'nama_lengkap' => 'required|string|max:255',
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($akun->id)],
            'password' => 'sometimes|nullable|string|max:20',
            'role' => 'required|string|max:255',
        ]);
    
        if ($request->filled('password')) {
            $validasiData['password'] = Hash::make($request->password);
        } else {
            unset($validasiData['password']);
        }
    
        $akun->update($validasiData);
    
        return redirect('/akun')->with('status', 'Data berhasil diedit.');
    }

    public function delete($id)
    {
        User::destroy($id);
        return back();
    }
}
