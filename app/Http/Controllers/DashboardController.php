<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use App\Models\Hutang;
use App\Models\Karyawan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // untuk sistem multi-user

        // Total data
        $totalPendapatan = Pendapatan::where('user_id', $userId)->sum('jumlah');
        $totalPengeluaran = Pengeluaran::where('user_id', $userId)->sum('jumlah');
        $totalHutang = Hutang::where('user_id', $userId)->sum('jumlah');

        $sisaUang = $totalPendapatan - $totalPengeluaran;

        // Data hari ini
        $today = Carbon::today();

        $pendapatanHariIni = Pendapatan::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->sum('jumlah');

        $pengeluaranHariIni = Pengeluaran::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->sum('jumlah');

        $hutangHariIni = Hutang::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->sum('jumlah');

        $jumlahKaryawan = Karyawan::where('user_id', $userId)->count();

        return view('dashboard', compact(
            'totalPendapatan',
            'totalPengeluaran',
            'sisaUang',
            'totalHutang',
            'pendapatanHariIni',
            'pengeluaranHariIni',
            'hutangHariIni',
            'jumlahKaryawan'
        ));
    }


    public function getChartData()
    {
        $userId = Auth::id();

        // Ambil data pendapatan per bulan
        $pendapatanPerBulan = Pendapatan::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->where('user_id', $userId)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        // Ambil data pengeluaran per bulan
        $pengeluaranPerBulan = Pengeluaran::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->where('user_id', $userId)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        // Siapkan data 12 bulan
        $labels = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $dataPendapatan = [];
        $dataPengeluaran = [];

        foreach ($labels as $bulan => $nama) {
            $dataPendapatan[] = $pendapatanPerBulan[$bulan] ?? 0;
            $dataPengeluaran[] = $pengeluaranPerBulan[$bulan] ?? 0;
        }

        return response()->json([
            'labels' => array_values($labels),
            'pendapatan' => $dataPendapatan,
            'pengeluaran' => $dataPengeluaran
        ]);
    }
}
