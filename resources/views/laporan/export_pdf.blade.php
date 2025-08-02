<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            text-align: center;
            font-weight: bold;
            font-size: 30px;
            color: #222;
        }
        h3 {
            text-align: left;
            font-weight: semibold;
            font-size: 18px;
            color: #333;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
            margin-top: 5px;
        }
        .section {
            margin-top: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f0f0f0;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            position: fixed;
            bottom: 20px;
            font-size: 10px;
            width: 100%;
            text-align: center;
        }
        .border {
            border-bottom: solid 2px #919191;
            margin-top: 10px;
        }
        .keuangan {
            text-align: center;
            font-weight: bold;
            font-size: 25px;
            color: #333333;
        }
    </style>
</head>
<body>

    <h1>Mitra Abadi Sentosa</h1>
    <h2 class="keuangan">Laporan Keuangan</h2>
    <h4>Untuk Periode Kuartal yang Berakhir pada Bulan {{ $bulan }}</h4>
    <div class="border"></div>

    {{-- Detail Transaksi --}}
    <div class="section">
        <h3>Detail Transaksi</h3>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    @if($jenis === 'hutang')
                        <th>Alasan</th>
                        <th>Penghutang</th>
                    @else
                        <th>Kategori</th>
                    @endif
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalUang = 0;
                @endphp
                @forelse($transaksis as $trx)
                    @php
                        $totalUang += $trx['jumlah'];
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($trx['tanggal'])->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($trx['jenis']) }}</td>
                        @if($jenis === 'hutang')
                            <td>{{ $trx['alasan'] }}</td>
                            <td>{{ $trx['penghutang'] }}</td>
                        @else
                            <td>{{ ucfirst($trx['kategori']) }}</td>
                        @endif
                        <td class="text-right">Rp {{ number_format($trx['jumlah'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $jenis === 'hutang' ? 5 : 4 }}" style="text-align: center;">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
                @if(count($transaksis) > 0)
                    <tr>
                        <td colspan="{{ $jenis === 'hutang' ? 4 : 3 }}" style="font-weight: bold; text-align: left;">Total</td>
                        <td class="text-right" style="font-weight: bold;">Rp {{ number_format($totalUang, 0, ',', '.') }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer">
        Dicetak tanggal: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}
    </div>

</body>
</html>
