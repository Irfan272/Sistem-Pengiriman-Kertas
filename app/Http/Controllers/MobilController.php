<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        return view("mobil.index", compact("mobils"));
    }

    public function create()
    {
        return view("mobil.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_mobil' => 'required|unique:mobils,plat_mobil',
            'merk'       => 'required',
            'status'     => 'required',
        ]);

        $data = [
            'plat_mobil' => $request->input('plat_mobil'),
            'merk'       => $request->input('merk'),
            'tipe'       => $request->input('tipe'),
            'warna'      => $request->input('warna'),
            'tahun'      => $request->input('tahun'),
            'status'     => $request->input('status'),
        ];

        Mobil::create($data);
        return redirect("/mobil")->with("status", "Data mobil berhasil ditambah");
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view("mobil.edit", compact("mobil"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plat_mobil' => 'required|unique:mobils,plat_mobil,' . $id,
            'merk'       => 'required',
            'status'     => 'required',
        ]);

        $data = [
            'plat_mobil' => $request->input('plat_mobil'),
            'merk'       => $request->input('merk'),
            'tipe'       => $request->input('tipe'),
            'warna'      => $request->input('warna'),
            'tahun'      => $request->input('tahun'),
            'status'     => $request->input('status'),
        ];

        Mobil::where('id', $id)->update($data);
        return redirect("/mobil")->with("status", "Data mobil berhasil diperbarui");
    }

    public function delete($id)
    {
        Mobil::destroy($id);
        return redirect('/mobil')->with('status', 'Data mobil berhasil dihapus');
    }

    public function view($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view("mobil.view", compact("mobil"));
    }
}
