 <table class="w-full">
      <thead>
        <tr class="bg-blue-500 text-white">
          <th class="px-6 py-4 text-left font-semibold text-md">No</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Nama</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Bulan</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Tranksaksi</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Total Uang</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Aksi</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Download</th>
        </tr>
      </thead>
      <tbody class="font-semibold text-gray-500">
        @forelse ($laporans as $index => $laporan)
        <tr data-row-id="{{ $laporan->id }}" class="bg-white border-b hover:bg-gray-100 transition-colors duration-150">
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $laporans->firstItem() + $index }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ ucfirst($laporan->nama) }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ \Carbon\Carbon::createFromFormat('Y-m', $laporan->bulan)->translatedFormat('F Y') }}</td>
          <td class="px-6 py-4 text-gray-700 text-center text-sm">{{ $laporan->jumlah_transaksi }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">Rp {{ number_format($laporan->total_uang, 2, ',', '.') }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">
             <div class="flex gap-2">
             <button 
                type="button" 
                data-id="{{ $laporan->id }}" 
                class="delete-button text-white bg-red-600 hover:bg-red-700 font-medium rounded-full text-xs px-4 py-2">
                <i class="fas fa-trash-alt mr-1"></i> Hapus
            </button>
            </div>
          <td class="px-6 py-4 text-gray-700 text-sm">
           <div class="flex gap-2">
               <a href="{{ route('laporan.export.excel', ['jenis' => $laporan->nama, 'bulan' => $laporan->bulan]) }}"
                  class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
                  <i class="fas fa-file-excel mr-1"></i> Excel
              </a>
                <a href="{{ route('laporan.export.pdf', ['jenis' => $laporan->nama, 'bulan' => $laporan->bulan]) }}"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>

            </div>

          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>