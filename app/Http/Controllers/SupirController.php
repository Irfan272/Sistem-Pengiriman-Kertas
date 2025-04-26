<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Supir;
use Illuminate\Http\Request;

class SupirController extends Controller
{
    public function index(){
        $supir = Supir::all();
        return view("supir.index", compact("supir"));
    }

    public function create(){
        $department = Department::all();
        return view("supir.create", compact("department"));
    }

    public function store(Request $request){
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'department_id' => 'required',
            'telepon' => 'required',
            'sim' => 'required',
        ]);

        $data = [
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'department_id' => $request->input('department_id'),
            'telepon' => $request->input('telepon'),
            'sim' => $request->input('sim'),
        ];

        Supir::create($data);
        return redirect("/supir")->with("status", "Data Berhasil Ditambah");
    }

    public function edit($id){
        $department = Department::all();
        $supir = Supir::findOrFail($id);

        return view("supir.edit", compact("supir", "department"));
    } 

    public function update(Request $request, $id){
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'department_id' => 'required',
            'telepon' => 'required',
            'sim' => 'required',
        ]);

        $data = [
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'department_id' => $request->input('department_id'),
            'telepon' => $request->input('telepon'),
            'sim' => $request->input('sim'),
        ];

        Supir::where('id', $id)->update($data);

        return redirect('/supir')->with('status', 'Data Berhasil Di Edit');

    }


    public function delete($id){
        Supir::destroy($id);
        return redirect('/supir')->with('status', 'Data Berhasil Di Hapus');
    }

    public function view($id){
        $department = Department::all();
        $supir = Supir::findOrFail($id);

        return view("supir.view", compact("supir", "department"));
    } 



}
