 <table class="w-full">
      <thead>
        <tr class="bg-blue-500 text-white">
          <th class="px-6 py-4 text-left font-semibold text-md">No</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Tanggal</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Jumlah</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Kategori</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Deskripsi</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Aksi</th>
        </tr>
      </thead>
      <tbody class="font-semibold text-gray-500">
        @forelse ($pengeluarans as $index => $pengeluaran)
        <tr data-row-id="{{ $pengeluaran->id }}" class="bg-white border-b hover:bg-gray-100 transition-colors duration-150">
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $pengeluarans->firstItem() + $index }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d-m-Y') }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $pengeluaran->kategori }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $pengeluaran->deskripsi ?? '-' }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">
            <div class="flex gap-2">
              <button 
                type="button" 
                data-id="{{ $pengeluaran->id }}" 
                class="edit-button text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-full text-xs px-5 py-2.5"
              >
                <i class="fas fa-edit mr-1"></i> Edit
            </button>
             <button 
                type="button" 
                data-id="{{ $pengeluaran->id }}" 
                class="delete-button text-white bg-red-600 hover:bg-red-700 font-medium rounded-full text-xs px-5 py-2.5">
                <i class="fas fa-trash-alt mr-1"></i> Hapus
            </button>
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