<?php

namespace App\Http\Controllers;

use App\Models\Pengecekan_Mobil;
use App\Models\Supir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengecekanMobilController extends Controller
{
    public function index()
    {
        $cek = Pengecekan_Mobil::with('Supir')->get();
        return view("pengecekan.index", compact("cek"));
    }

    public function create()
    {
        $supir = Supir::all();
        return view("pengecekan.create", compact("supir"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'supir_id' => 'required',
            'plat_mobil' => 'required',
            'tanggal_pengecekan' => 'required|date',
            'shift_pengecekan' => 'required',
            'alarm' => 'required|boolean',
            'lampu_penerangan' => 'required|boolean',
            'lampu_rem' => 'required|boolean',
            'rem' => 'required|boolean',
            'sen_kanan' => 'required|boolean',
            'sen_kiri' => 'required|boolean',
            'klakson' => 'required|boolean',
            'safety_belt' => 'required|boolean',
            'bukti_video' => 'required|file|mimes:mp4,avi,mov|max:30240', // 30MB
        ]);

        // Simpan video ke storage (folder: videos)
        $videoPath = $request->file('bukti_video')->store('videos', 'public');

        // Ambil nilai integer dari request
        $alarm = $request->input('alarm');
        $lampu_penerangan = $request->input('lampu_penerangan');
        $lampu_rem = $request->input('lampu_rem');
        $rem = $request->input('rem');
        $sen_kanan = $request->input('sen_kanan');
        $sen_kiri = $request->input('sen_kiri');
        $klakson = $request->input('klakson');
        $safety_belt = $request->input('safety_belt');

        // Cek apakah semua checklist bernilai 1
        $status = ($alarm == 1 &&
            $lampu_penerangan == 1 &&
            $lampu_rem == 1 &&
            $rem == 1 &&
            $sen_kanan == 1 &&
            $sen_kiri == 1 &&
            $klakson == 1 &&
            $safety_belt == 1) ? "Approve" : "Reject";

        // Simpan data ke database
        Pengecekan_Mobil::create([
            'supir_id' => $request->input('supir_id'),
            'plat_mobil' => $request->input('plat_mobil'),
            'tanggal_pengecekan' => $request->input('tanggal_pengecekan'),
            'shift_pengecekan' => $request->input('shift_pengecekan'),
            'alarm' => $request->input('alarm'),
            'lampu_penerangan' => $request->input('lampu_penerangan'),
            'lampu_rem' => $request->input('lampu_rem'),
            'rem' => $request->input('rem'),
            'sen_kanan' => $request->input('sen_kanan'),
            'sen_kiri' => $request->input('sen_kiri'),
            'klakson' => $request->input('klakson'),
            'safety_belt' => $request->input('safety_belt'),
            'bukti_video' => $videoPath,
            'status' => $status, // Simpan status berdasarkan kondisi
        ]);

        return redirect("/pengecekan")->with("status", "Data Berhasil Ditambah");
    }

    public function edit($id)
    {
        $supir = Supir::all();
        $pengecekan = Pengecekan_Mobil::findOrFail($id);

        return view("pengecekan.edit", compact("supir", "pengecekan"));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'supir_id' => 'required',
            'plat_mobil' => 'required',
            'tanggal_pengecekan' => 'required|date',
            'shift_pengecekan' => 'required',
            'alarm' => 'required|boolean',
            'lampu_penerangan' => 'required|boolean',
            'lampu_rem' => 'required|boolean',
            'rem' => 'required|boolean',
            'sen_kanan' => 'required|boolean',
            'sen_kiri' => 'required|boolean',
            'klakson' => 'required|boolean',
            'safety_belt' => 'required|boolean',
            'bukti_video' => 'nullable|file|mimes:mp4,avi,mov|max:30240', // 30MB
        ]);

        // Ambil data yang akan diupdate
        $pengecekan = Pengecekan_Mobil::findOrFail($id);

        // Simpan file video jika ada yang baru
        if ($request->hasFile('bukti_video')) {
            // Simpan video baru
            $videoPath = $request->file('bukti_video')->store('videos', 'public');

            // Hapus video lama jika ada
            if ($pengecekan->bukti_video) {
                Storage::disk('public')->delete($pengecekan->bukti_video);
            }
        } else {
            // Gunakan file lama jika tidak ada video baru
            $videoPath = $pengecekan->bukti_video;
        }

        $alarm = $request->input('alarm');
        $lampu_penerangan = $request->input('lampu_penerangan');
        $lampu_rem = $request->input('lampu_rem');
        $rem = $request->input('rem');
        $sen_kanan = $request->input('sen_kanan');
        $sen_kiri = $request->input('sen_kiri');
        $klakson = $request->input('klakson');
        $safety_belt = $request->input('safety_belt');

        // Cek apakah semua checklist bernilai 1
        $status = ($alarm == 1 &&
            $lampu_penerangan == 1 &&
            $lampu_rem == 1 &&
            $rem == 1 &&
            $sen_kanan == 1 &&
            $sen_kiri == 1 &&
            $klakson == 1 &&
            $safety_belt == 1) ? "Approve" : "Reject";

        // Update data di database
        $pengecekan->update([
            'supir_id' => $request->input('supir_id'),
            'plat_mobil' => $request->input('plat_mobil'),
            'tanggal_pengecekan' => $request->input('tanggal_pengecekan'),
            'shift_pengecekan' => $request->input('shift_pengecekan'),
            'alarm' => $request->input('alarm'),
            'lampu_penerangan' => $request->input('lampu_penerangan'),
            'lampu_rem' => $request->input('lampu_rem'),
            'rem' => $request->input('rem'),
            'sen_kanan' => $request->input('sen_kanan'),
            'sen_kiri' => $request->input('sen_kiri'),
            'klakson' => $request->input('klakson'),
            'safety_belt' => $request->input('safety_belt'),
            'bukti_video' => $videoPath,
            'status' => $status,
        ]);

        return redirect('/pengecekan')->with('status', 'Data Berhasil Diedit');
    }



    public function delete($id)
    {
        Pengecekan_Mobil::destroy($id);
        return redirect('/pengecekan')->with('status', 'Data Berhasil Di Hapus');
    }

    public function view($id)
    {
        $supir = Supir::all();
        $pengecekan = Pengecekan_Mobil::findOrFail($id);

        return view("pengecekan.view", compact("supir", "pengecekan"));
    }

}
