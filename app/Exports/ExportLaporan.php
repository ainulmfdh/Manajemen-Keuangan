<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportLaporan implements FromArray, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
{
    protected $data;
    protected $jenis;

    public function __construct(Collection $data, $jenis)
    {
        $this->data = $data;
        $this->jenis = $jenis;
    }

    public function array(): array
    {
        $rows = [];
        $no = 1;
        $total = 0;

        foreach ($this->data as $item) {
            $tanggal = \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y');

            if ($this->jenis === 'hutang') {
                $row = [
                    'no' => $no++,
                    'tanggal' => $tanggal,
                    'jenis' => $item['jenis'],
                    'penghutang' => $item['penghutang'],
                    'alasan' => $item['alasan'],
                    'jumlah' => $item['jumlah'],
                ];
            } else {
                $row = [
                    'no' => $no++,
                    'tanggal' => $tanggal,
                    'jenis' => $item['jenis'],
                    'kategori' => $item['kategori'],
                    'jumlah' => $item['jumlah'],
                ];
            }

            $total += $item['jumlah'];
            $rows[] = $row;
        }

        // Tambahkan baris total
        if ($this->jenis === 'hutang') {
            $rows[] = [
                'no' => 'TOTAL',
                'tanggal' => '',
                'jenis' => '',
                'penghutang' => '',
                'alasan' => '',
                'jumlah' => $total,
            ];
        } else {
            $rows[] = [
                'no' => 'TOTAL',
                'tanggal' => '',
                'jenis' => '',
                'kategori' => '',
                'jumlah' => $total,
            ];
        }

        return $rows;
    }

    public function headings(): array
    {
        if ($this->jenis === 'hutang') {
            return ['No', 'Tanggal', 'Jenis', 'Penghutang', 'Alasan', 'Jumlah'];
        } else {
            return ['No', 'Tanggal', 'Jenis', 'Kategori', 'Jumlah'];
        }
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = count($this->data) + 2;
        $lastRow = $rowCount;
        $lastCol = $this->jenis === 'hutang' ? 'F' : 'E';

        // Style heading
        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'center'],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'DCE6F1']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // Border all cells
        $sheet->getStyle("A1:{$lastCol}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // Center kolom No
        $sheet->getStyle("A2:A{$lastRow}")
              ->getAlignment()
              ->setHorizontal('center');

        // Format angka jumlah
        $sheet->getStyle("{$lastCol}2:{$lastCol}{$lastRow}")
              ->getNumberFormat()
              ->setFormatCode('#,##0');

        // Baris Total
        $mergeEndCol = $this->jenis === 'hutang' ? 'E' : 'D';
        $sheet->mergeCells("A{$lastRow}:{$mergeEndCol}{$lastRow}");
        $sheet->getStyle("A{$lastRow}:{$mergeEndCol}{$lastRow}")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'left'],
        ]);
        $sheet->getStyle("{$lastCol}{$lastRow}")->applyFromArray([
            'font' => ['bold' => true],
        ]);

        return [];
    }

    public function title(): string
    {
        return 'Laporan Keuangan';
    }
}

