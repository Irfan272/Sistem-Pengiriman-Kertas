<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $department = Department::all();
        return view("department.index", compact("department"));
    }

    public function create(){
        return view("department.create");
    }

    public function store(Request $request){
        $request->validate([
           
            'nama' => 'required',
           
        ]);

        $data = [
           
            'nama' => $request->input('nama'),
            
        ];

        Department::create($data);
        return redirect("/department")->with("status", "Data Berhasil Ditambah");
    }

    public function edit($id){
        $department = Department::findOrFail($id);

        return view("department.edit", compact("department"));
    } 

    public function update(Request $request, $id){
        $request->validate([
           
            'nama' => 'required',
           
        ]);

        $data = [
           
            'nama' => $request->input('nama'),
            
        ];

        Department::where('id', $id)->update($data);

        return redirect('/department')->with('status', 'Data Berhasil Di Edit');

    }


    public function delete($id){
        Department::destroy($id);
        return redirect('/department')->with('status', 'Data Berhasil Di Hapus');
    }

    public function view($id){
        $department = Department::findOrFail($id);

        return view("department.view", compact("department"));
    } 
}
