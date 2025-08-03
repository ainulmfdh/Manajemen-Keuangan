 <table class="w-full">
      <thead>
        <tr class="bg-blue-500 text-white">
          <th class="px-6 py-4 text-left font-semibold text-md">No</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Nama</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Posisi</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Alamat</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Umur</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Kontak</th>
          <th class="px-6 py-4 text-left font-semibold text-md">Aksi</th>
        </tr>
      </thead>
      <tbody class="font-semibold text-gray-500">
        @forelse ($karyawans as $index => $karyawan)
        <tr data-row-id="{{ $karyawan->id }}" class="bg-white border-b hover:bg-gray-100 transition-colors duration-150">
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $karyawans->firstItem() + $index }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $karyawan->nama }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $karyawan->posisi }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $karyawan->alamat }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $karyawan->umur }}</td>
          <td class="px-6 py-4 text-gray-700 text-sm">{{ $karyawan->kontak }}</td>
          <td class="px-6 py-4 text-gray-700">
            <div class="flex gap-2">
              <button 
                type="button" 
                data-id="{{ $karyawan->id }}" 
                class="edit-button text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-full text-xs px-5 py-2.5"
              >
                <i class="fas fa-edit mr-1"></i> Edit
            </button>
             <button 
                type="button" 
                data-id="{{ $karyawan->id }}" 
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