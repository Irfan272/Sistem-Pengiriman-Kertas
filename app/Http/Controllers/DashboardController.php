<?php

namespace App\Http\Controllers;

use App\Models\Pengecekan_Mobil;
use App\Models\Pengiriman;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $pengecekanTotal = Pengecekan_Mobil::count();

        $laporanDiterimaCounts = Pengiriman::select('status', DB::raw('count(*) as total'))
        ->whereIn('status', ['Selesai'])
        ->groupBy('status')
        ->pluck('total', 'status')
        ->all();

        $laporanDiprosesCounts = Pengiriman::select('status', DB::raw('count(*) as total'))
        ->whereIn('status', ['Menunggu'])
        ->groupBy('status')
        ->pluck('total', 'status')
        ->all();

        $laporanDitolakCounts = Pengiriman::select('status', DB::raw('count(*) as total'))
        ->whereIn('status', ['Ditolak'])
        ->groupBy('status')
        ->pluck('total', 'status')
        ->all();

        $pengirimanProses = Pengiriman::with('Supir', 'Pengecekan')->where('status', 'Menunggu')->get();
        $pengirimanDitolak = Pengiriman::with('Supir', 'Pengecekan')->where('status', 'Ditolak')->get();

       


    

        return view('dashboard', compact('pengecekanTotal', 'laporanDiterimaCounts', 'laporanDitolakCounts', 'laporanDiprosesCounts', 'pengirimanProses', 'pengirimanDitolak'));
    }
}
