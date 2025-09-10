<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use App\Models\Hutang;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportLaporan;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends Controller
{
    // FUNCTION VIEW LAPORAN
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->format('Y-m');
        $user_id = Auth::id();

        $laporans = Laporan::where('user_id', $user_id)
            ->when($request->q, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('bulan', 'like', '%' . $search . '%')
                    ->orWhere('total_uang', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('bulan', 'asc')
            ->paginate(5);

        // Data detail per bulan
        $Pendapatan = Pendapatan::where('user_id', $user_id)
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))->get();
        $pengeluaran = Pengeluaran::where('user_id', $user_id)
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))->get();
        $hutang = Hutang::where('user_id', $user_id)
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))->get();

        if ($request->ajax()) {
            return view('laporan.table', compact('laporans'))->render();
        }

        return view('laporan.index', compact('laporans', 'Pendapatan', 'pengeluaran', 'hutang', 'bulan'));
    }


    // TAMBAH/BUAT LAPORAN
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|in:pendapatan,pengeluaran,hutang',
            'bulan' => 'required|date_format:Y-m',
        ]);

        $nama = $request->nama;
        $bulan = $request->bulan;
        $user_id = Auth::id();

        [$year, $month] = explode('-', $bulan);

        switch ($nama) {
            case 'pendapatan':
                $query = Pendapatan::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month);
                break;

            case 'pengeluaran':
                $query = Pengeluaran::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month);
                break;

            case 'hutang':
                $query = Hutang::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month);
                break;

            default:
                return back()->with('error', 'Jenis tidak valid.');
        }

        $jumlahTransaksi = $query->count();
        $totalUang = $query->sum('jumlah');

        Laporan::create([
            'user_id' => $user_id,
            'nama' => $nama,
            'bulan' => $bulan,
            'jumlah_transaksi' => $jumlahTransaksi,
            'total_uang' => $totalUang,
        ]);

        return redirect()->back()->with('success', 'Data laporan berhasil disimpan.');
    }

    // HITUNG TRANSAKSI TOTAL 
    public function hitungTransaksi(Request $request)
    {
        $jenis = $request->query('jenis');
        $bulan = $request->query('bulan'); // format: YYYY-MM
        $user_id = Auth::id();

        if (!$jenis || !$bulan) {
            return response()->json(['jumlah' => 0, 'total' => 0]);
        }

        [$year, $month] = explode('-', $bulan);
        $jumlah = 0;
        $total = 0;

        switch ($jenis) {
            case 'pendapatan':
                $jumlah = Pendapatan::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->count();
                $total = Pendapatan::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('jumlah');
                break;

            case 'pengeluaran':
                $jumlah = Pengeluaran::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->count();
                $total = Pengeluaran::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('jumlah');
                break;

            case 'hutang':
                $jumlah = Hutang::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->count();
                $total = Hutang::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('jumlah');
                break;

            default:
                // do nothing
                break;
        }

        return response()->json([
            'jumlah' => $jumlah,
            'total' => $total
        ]);
    }

    // DELETE LAPORAN
     public function destroy($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())->findOrFail($id);
        $laporan->delete();

        return response()->json(['success' => true]);
    }


    // EXPORTS PDF
   public function exportPDF(Request $request)
    {
        $user_id = auth()->id();
        $jenis = $request->input('jenis'); // pendapatan, pengeluaran, hutang
        $bulan = $request->input('bulan'); // format: YYYY-MM

        if (!$jenis || !$bulan) {
            return back()->with('error', 'Jenis dan bulan harus dipilih.');
        }

        [$year, $month] = explode('-', $bulan);

        // Ambil data transaksi sesuai jenis
        switch ($jenis) {
            case 'pendapatan':
                $data = Pendapatan::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->get(['tanggal', 'jumlah', 'kategori'])
                    ->map(function ($item) {
                        return [
                            'tanggal' => $item->tanggal,
                            'jumlah' => $item->jumlah,
                            'kategori' => $item->kategori,
                            'jenis' => 'pendapatan',
                        ];
                    });
                break;

            case 'pengeluaran':
                $data = Pengeluaran::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->get(['tanggal', 'jumlah', 'kategori'])
                    ->map(function ($item) {
                        return [
                            'tanggal' => $item->tanggal,
                            'jumlah' => $item->jumlah,
                            'kategori' => $item->kategori,
                            'jenis' => 'pengeluaran',
                        ];
                    });
                break;

            case 'hutang':
                $data = Hutang::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->get(['tanggal', 'jumlah', 'alasan', 'penghutang'])
                    ->map(function ($item) {
                        return [
                            'tanggal'    => $item->tanggal,
                            'jumlah'     => $item->jumlah,
                            'alasan'     => $item->alasan,
                            'penghutang' => $item->penghutang,
                            'jenis' => 'hutang',
                        ];
                    });
                break;

            default:
                $data = collect();
        }

        $pdf = PDF::loadView('laporan.export_pdf', [
            'transaksis' => $data,
            'jenis' => $jenis,
            'bulan' => \Carbon\Carbon::createFromDate($year, $month)->isoFormat('MMMM YYYY'),
        ]);

        return $pdf->download("laporan_{$jenis}_{$bulan}.pdf");
    }

    // EXPORTS LAPORAN EXCEL
   public function exportExcel(Request $request)
    {
        $user_id = auth()->id();
        $jenis = $request->input('jenis');
        $bulan = $request->input('bulan');

        if (!$jenis || !$bulan) {
            return back()->with('error', 'Jenis dan bulan harus dipilih.');
        }

        [$year, $month] = explode('-', $bulan);

        switch ($jenis) {
            case 'pendapatan':
                $data = Pendapatan::where('user_id', $user_id)
                    ->whereMonth('tanggal', $month)
                    ->whereYear('tanggal', $year)
                    ->get(['tanggal', 'jumlah', 'kategori'])
                    ->map(function ($item) {
                        return [
                            'tanggal' => $item->tanggal,
                            'jumlah' => $item->jumlah,
                            'kategori' => $item->kategori,
                            'jenis' => 'pendapatan',
                        ];
                    });
                break;

            case 'pengeluaran':
                $data = Pengeluaran::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->get(['tanggal', 'jumlah', 'kategori'])
                    ->map(function ($item) {
                        return [
                            'tanggal' => $item->tanggal,
                            'jumlah' => $item->jumlah,
                            'kategori' => $item->kategori,
                            'jenis' => 'pengeluaran',
                        ];
                    });
                break;

            case 'hutang':
                $data = Hutang::where('user_id', $user_id)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->get(['tanggal', 'jumlah', 'alasan', 'penghutang'])
                    ->map(function ($item) {
                        return [
                            'tanggal' => $item->tanggal,
                            'jumlah' => $item->jumlah,
                            'alasan' => $item->alasan,
                            'penghutang' => $item->penghutang,
                            'jenis' => 'hutang',
                        ];
                    });
                break;

            default:
                $data = collect();
        }

        $export = new ExportLaporan($data, $jenis);
        $filename = "laporan_{$jenis}_{$bulan}.xlsx";

        return Excel::download($export, $filename);
    }


    public function riwayat(Request $request)
    {
        $bulan = $request->bulan ?? now()->format('Y-m');
        $user_id = Auth::id();

        $laporans = Laporan::where('user_id', $user_id)
            ->when($request->q, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('bulan', 'like', '%' . $search . '%')
                    ->orWhere('total_uang', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('bulan', 'asc')
            ->paginate(10);

        // Data detail per bulan
        $Pendapatan = Pendapatan::where('user_id', $user_id)
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))->get();
        $pengeluaran = Pengeluaran::where('user_id', $user_id)
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))->get();
        $hutang = Hutang::where('user_id', $user_id)
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))->get();

        if ($request->ajax()) {
            return view('laporan.table', compact('laporans'))->render();
        }

        // Antrian prioritas: ambil laporan dengan total_uang terbesar
        $queue = $laporans->sortByDesc('total_uang')->values();

        // Ambil 5 teratas
        $topLaporans = $queue->take(5);

        return view('laporan.riwayat', compact('laporans', 'Pendapatan', 'pengeluaran', 'hutang', 'bulan'));
    }

}