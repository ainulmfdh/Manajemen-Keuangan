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
        @forelse ($pendapatans as $index => $pendapatan)
        <tr data-row-id="{{ $pendapatan->id }}" class="bg-white border-b hover:bg-gray-100 transition-colors duration-150">
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $pendapatans->firstItem() + $index }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ \Carbon\Carbon::parse($pendapatan->tanggal)->format('d-m-Y') }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">Rp {{ number_format($pendapatan->jumlah, 0, ',', '.') }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $pendapatan->kategori }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $pendapatan->deskripsi ?? '-' }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">
            <div class="flex gap-2">
              <button 
                type="button" 
                data-id="{{ $pendapatan->id }}" 
                class="edit-button text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-full text-xs px-5 py-2.5"
              >
                <i class="fas fa-edit mr-1"></i> Edit
            </button>
             <button 
                type="button" 
                data-id="{{ $pendapatan->id }}" 
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