<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Laporan::where('user_id', auth()->id())->get([
            'nama', 'bulan', 'jumlah_transaksi', 'total_uang'
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Bulan',
            'Jumlah Transaksi',
            'Total Uang'
        ];
    }
}
