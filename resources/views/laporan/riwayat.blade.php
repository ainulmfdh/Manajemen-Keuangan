<x-app-layout>
<!-- Menu Queue: Top 5 Total Uang Terbesar -->
  <div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-3">Data Laporan Jumlah Uang Terbesar</h2>
    <table class="w-full">
      <thead>
        <tr class="bg-blue-500 text-white">
          <th class="px-6 py-4 text-left font-semibold text-md">Nama</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Bulan</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Total Uang</th>
        </tr>
      </thead>
      <tbody class="font-semibold text-gray-500">
        @forelse($laporans->sortByDesc('total_uang')->take(5) as $laporan)
        <tr class="bg-white border-b hover:bg-gray-100 transition-colors duration-150">
          <td class="px-6 py-4 text-gray-700 text-md">{{ ucfirst($laporan->nama) }}</td>
          <td class="px-6 py-4 text-gray-700 text-md">
            {{ \Carbon\Carbon::createFromFormat('Y-m', $laporan->bulan)->translatedFormat('F Y') }}
          </td>
          <td class="px-6 py-4 text-blue-600 font-bold text-md">
            Rp {{ number_format($laporan->total_uang, 2, ',', '.') }}
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</x-app-layout>