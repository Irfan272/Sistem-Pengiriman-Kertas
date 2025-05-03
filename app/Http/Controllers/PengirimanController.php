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
        $pengecekan = collect(); // kosongkan dulu

        // Jika ada selected_id dari pengiriman sebelumnya
        if ($request->filled('selected_id')) {
            $existing = Pengecekan_Mobil::where('id', $request->selected_id)->first();
            if ($existing) {
                $pengecekan->push($existing); // masukkan ke dalam koleksi hasil
            }
        }

        // Jika TIDAK ada selected_id, atau sedang ganti supir, maka ambil berdasarkan supir
        if (!$request->filled('selected_id') && $request->filled('supir_id')) {
            $pengecekan = Pengecekan_Mobil::where('supir_id', $request->supir_id)->get();
        }

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
            'status_approval_1' => 'nullable|string',
            'remaks_1' => 'nullable|string',
            'user_2' => 'required|exists:users,id',
            'status_approval_2' => 'nullable|string',
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
                'user_1' => $request->user_1,
                'user_2' => $request->user_2,

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
        $pengecekan = Pengecekan_Mobil::all();
        $user1 = User::whereIn('role', ['Kordinator Lapangan'])->get();
        $user2 = User::whereIn('role', ['Kepala Bagian'])->get();
        $details = Pengiriman_Detail::where('pengiriman_id', $pengiriman->id)->get();

        return view("pengiriman.edit", compact("pengiriman", "supir", "kertas", "user1", "user2", "details", "pengecekan"));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'supir_id' => 'required|exists:supirs,id',
            'pengecekan_mobil_id' => 'required|exists:pengecekan_mobils,id',
            'shift' => 'required|string',
            'tanggal_pengiriman' => 'required|date_format:Y-m-d',
            'jam_masuk' => 'required|date_format:H:i:s',
            'jam_keluar' => 'required|date_format:H:i:s',
            'user_1' => 'required|exists:users,id',
            'status_approval_1' => 'nullable|string',
            'remaks_1' => 'nullable|string',
            'user_2' => 'required|exists:users,id',
            'status_approval_2' => 'nullable|string',
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


        DB::transaction(function () use ($request, $id) {
            $pengiriman = Pengiriman::findOrFail($id);

            $totalTonase = array_sum($request->tonase_kg);
            $totalRitase = array_sum($request->ritase);

            $tanggal = $request->input('tanggal_pengiriman');

            $status_approval_1 =  $request->input('status_approval_1');
            $status_approval_2 =  $request->input('status_approval_2');

         

            if ($status_approval_1 === 'Reject' || $status_approval_2 === 'Reject') {
                $status = 'Ditolak';
            } elseif ($status_approval_1 === 'Approve' && $status_approval_2 === 'Approve') {
                $status = 'Selesai';
            } else {
                $status = 'Menunggu';
            }
            



            $pengiriman->update([
                'supir_id' => $request->supir_id,
                'pengecekan_mobil_id' => $request->pengecekan_mobil_id,
                'shift' => $request->shift,
                'total_tonase' => $totalTonase,
                'total_ritase' => $totalRitase,
                'tanggal_pengiriman' => $tanggal,
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar,
                'user_1' => $request->user_1,
                'status_approval_1' => $request->status_approval_1,
                'remaks_1' => $request->remaks_1,
                'user_2' => $request->user_2,
                'status_approval_2' => $request->status_approval_2,
                'remaks_2' => $request->remaks_2,

                'status' => $status,
            ]);

            // Hapus semua detail lama lalu tambahkan ulang
            Pengiriman_Detail::where('pengiriman_id', $pengiriman->id)->delete();

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

        return redirect('/pengiriman')->with('status', 'Data Berhasil Diedit');
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
