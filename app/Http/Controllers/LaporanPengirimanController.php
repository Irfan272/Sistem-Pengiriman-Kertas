<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanPengirimanController extends Controller
{
    public function index(){
        return view("laporan.pengiriman.index");
    }

    public function printPengiriman($tanggal_awal, $tanggal_akhir)
    {
        $tanggal_mulai = Carbon::parse($tanggal_awal)->startOfDay()->format('Y-m-d H:i:s');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->endOfDay()->format('Y-m-d H:i:s');

        $pengiriman = Pengiriman::with(['Supir', 'Pengecekan'])
            ->whereBetween('tanggal_pengiriman', [$tanggal_mulai, $tanggal_terakhir])
            ->get();

        $total = $pengiriman->count();
        $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

        return view('laporan.pengiriman.cetak', compact('pengiriman', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }

    // public function getPengirimanData(Request $request)
    // {
    //     $tanggal_awal = $request->input('tanggal_awal');
    //     $tanggal_akhir = $request->input('tanggal_akhir');
    
    //     // Pastikan tanggal awal dan tanggal akhir ada
    //     if (!$tanggal_awal || !$tanggal_akhir) {
    //         return response()->json(['error' => 'Tanggal awal dan akhir diperlukan'], 400);
    //     }
    
    //     // Ambil data dari database
    //     $data = Pengiriman::whereBetween('tanggal_pengiriman', [$tanggal_awal, $tanggal_akhir])
    //         ->with(['Supir', 'Pengecekan'])
    //         ->get();
    
    //     // Periksa apakah data ditemukan
    //     if ($data->isEmpty()) {
    //         return response()->json(['message' => 'Tidak ada data yang ditemukan'], 404);
    //     }
    
    //     // Format data sesuai kebutuhan
    //     $formattedData = $data->map(function ($item, $index) {
    //         return [
    //             'No' => $index + 1, // Menambahkan nomor urut dimulai dari 1
    //             'Supir' => $item->Supir->nama,
    //             'Plat Mobil' => $item->plat_mobil,
    //             'Tanggal Pengecekan' => $item->tanggal_pengecekan,
    //             'Shift Pengecekan' => $item->shift_pengecekan,
    //             'Alarm' => $item->alarm,
    //             'Lampu Penerangan' => $item->lampu_penerangan,
    //             'Lampu Rem' => $item->lampu_rem,
    //             'Rem' => $item->rem,
    //             'Sen Kanan' => $item->sen_kanan,
    //             'Sen Kiri' => $item->sen_kiri,
    //             'Klakson' => $item->klakson,
    //             'Safety Belt' => $item->safety_belt,
    //             'Status' => $item->status,
    //         ];
    //     });
    
    //     // Kembalikan data dalam bentuk JSON
    //     return response()->json($formattedData);
    // }
}
