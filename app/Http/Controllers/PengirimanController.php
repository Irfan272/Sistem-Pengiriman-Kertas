<?php

namespace App\Http\Controllers;

use App\Models\Kertas;
use App\Models\Pengecekan_Mobil;
use App\Models\Pengiriman;
use App\Models\Pengiriman_Detail;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Log;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::with('Supir', 'Pengecekan')->get();
        return view("pengiriman.index", compact("pengiriman", ));
    }

    public function create()
    {
        $supir = Supir::all();
        $kertas = Kertas::all();
        $user1 = User::whereIn('role', ['Kordinator Lapangan'])->get();
        $user2 = User::whereIn('role', ['Kepala Bagian'])->get();

        // $pengecekan = Pengecekan_Mobil::all();

        return view("pengiriman.create", compact("supir", "kertas", "user1", "user2"));
    }

    public function getPengecekanMobil(Request $request)
    {
        $pengecekan = Pengecekan_Mobil::where('supir_id', $request->supir_id)->get();

        return response()->json($pengecekan);
    }


    public function store(Request $request)
    {
        $request->validate([
            'supir_id' => 'required|exists:supirs,id',
            'pengecekan_mobil_id' => 'required|exists:pengecekan_mobils,id',
            'shift' => 'required|string',
            'tanggal_pengiriman' => 'required|date_format:Y-m-d',
            'jam_masuk' => 'required|date_format:H:i:s',
            'jam_keluar' => 'required|date_format:H:i:s',
            'user_1' => 'required|exists:users,id',
            'status_approval_1' => 'required|string',
            'remaks_1' => 'nullable|string',
            'user_2' => 'required|exists:users,id',
            'status_approval_2' => 'required|string',
            'remaks_2' => 'nullable|string',
            'kertas_id' => 'required|array',
            'kertas_id.*' => 'required|exists:kertas,id',
            'tonase_kg' => 'required|array',
            'tonase_kg.*' => 'required|numeric',
            'ritase' => 'required|array',
            'ritase.*' => 'required|numeric',
            'lokasi' => 'required|array',
            'lokasi.*' => 'required|string|max:255',
        ]);


        DB::transaction(function () use ($request) {

            $totalTonase = array_sum($request->tonase_kg);
            $totalRitase = array_sum($request->ritase);

            $tanggal = $request->input('tanggal_pengiriman');
            $jamMasuk = $request->input('jam_masuk');
            $jamKeluar = $request->input('jam_keluar');

            $jamMasukFull = $tanggal . ' ' . $jamMasuk;
            $jamKeluarFull = $tanggal . ' ' . $jamKeluar;

            $pengiriman = Pengiriman::create([
                'supir_id' => $request->supir_id,
                'pengecekan_mobil_id' => $request->pengecekan_mobil_id,
                'shift' => $request->shift,
                'total_tonase' => $totalTonase,
                'total_ritase' => $totalRitase,
                'tanggal_pengiriman' => $request->tanggal_pengiriman,
                'jam_masuk' => $jamMasukFull,
                'jam_keluar' => $jamKeluarFull,

                'status' => 'Menunggu',
            ]);

            foreach ($request->kertas_id as $index => $kertas_id) {
                Pengiriman_Detail::create([
                    'pengiriman_id' => $pengiriman->id,
                    'kertas_id' => $kertas_id,
                    'tonase_kg' => $request->tonase_kg[$index],
                    'ritase' => $request->ritase[$index],
                    'lokasi' => $request->lokasi[$index],

                ]);
            }
        });

        return redirect('/pengiriman')->with('status', 'Data Pengiriman Berhasil Ditambahkan!');
    }


    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $supir = Supir::all();
        $kertas = Kertas::all();
        $user1 = User::whereIn('role', ['Kordinator Lapangan'])->get();
        $user2 = User::whereIn('role', ['Kepala Bagian'])->get();
        $details = Pengiriman_Detail::where('pengiriman_id', $pengiriman->id)->get();
    
        return view("pengiriman.edit", compact("pengiriman", "supir", "kertas", "user1", "user2", "details"));
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
            'sen_klakson' => 'required|boolean',
            'safety_belt' => 'required|boolean',
            'bukti_video' => 'nullable|file|mimes:mp4,avi,mov|max:10240', // 10MB, nullable agar tidak wajib
        ]);

        // Ambil data yang akan diupdate
        $pengecekan = Pengecekan_Mobil::findOrFail($id);

        // Cek apakah ada video baru diunggah
        if ($request->hasFile('bukti_video')) {
            // Simpan video baru
            $videoPath = $request->file('bukti_video')->store('videos', 'public');

            // Hapus video lama jika ada
            if ($pengecekan->bukti_video) {
                Storage::disk('public')->delete($pengecekan->bukti_video);
            }
        } else {
            // Gunakan video lama jika tidak ada yang baru
            $videoPath = $pengecekan->bukti_video;
        }

        // Cek apakah semua checklist bernilai true
        $status = $request->input('alarm') &&
            $request->input('lampu_penerangan') &&
            $request->input('lampu_rem') &&
            $request->input('rem') &&
            $request->input('sen_kanan') &&
            $request->input('sen_kiri') &&
            $request->input('sen_klakson') &&
            $request->input('safety_belt');

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
            'sen_klakson' => $request->input('sen_klakson'),
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
        $cek = Pengecekan_Mobil::findOrFail($id);

        return view("pengecekan.edit", compact("supir", "cek"));
    }
}
