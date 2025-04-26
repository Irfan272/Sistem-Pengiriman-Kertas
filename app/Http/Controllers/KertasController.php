<?php

namespace App\Http\Controllers;

use App\Models\Kertas;
use Illuminate\Http\Request;

class KertasController extends Controller
{
    public function index(){
        $kertas = Kertas::all();
        return view("kertas.index", compact("kertas"));
    }

    public function create(){
        return view("kertas.create");
    }

    public function store(Request $request){
        $request->validate([
           
            'jenis_kertas' => 'required',
            'lokasi' => 'required',
           
        ]);

        $data = [
           
            'jenis_kertas' => $request->input('jenis_kertas'),
            'lokasi' => $request->input('lokasi'),
            
        ];

        Kertas::create($data);
        return redirect("/kertas")->with("status", "Data Berhasil Ditambah");
    }

    public function edit($id){
        $kertas = Kertas::findOrFail($id);

        return view("kertas.edit", compact("kertas"));
    } 

    public function update(Request $request, $id){
        $request->validate([
           
            'jenis_kertas' => 'required',
            'lokasi' => 'required',
           
        ]);

        $data = [
           
            'jenis_kertas' => $request->input('jenis_kertas'),
            'lokasi' => $request->input('lokasi'),
            
        ];

        Kertas::where('id', $id)->update($data);

        return redirect('/kertas')->with('status', 'Data Berhasil Di Edit');

    }


    public function delete($id){
        Kertas::destroy($id);
        return redirect('/kertas')->with('status', 'Data Berhasil Di Hapus');
    }

    public function view($id){
        $kertas = Kertas::findOrFail($id);

        return view("kertas.view", compact("kertas"));
    } 
}
