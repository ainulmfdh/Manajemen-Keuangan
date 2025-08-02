<!-- form-edit -->
<div id="modalFormEdit" class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 space-y-4">
    <h2 class="text-2xl font-bold text-gray-700">Ubah Data Pemasukan</h2>
    <form id="editlaporanForm" method="POST" class="space-y-4">
        @csrf
            {{-- Untuk method PUT/PATCH, Laravel butuh method spoofing --}}
            @method('POST')
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input
          type="text"
          id="edit-nama"
          name="nama"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Bulan</label>
        <input
          type="date"
          name="bulan"
          id="edit-bulan"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Jumlah Transaksi</label>
        <input
          type="number"
          name="jumlah_transaksi"
          id="edit-jumlah_transaksi"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="Gaji, Bonus, Lainnya"
          required
        />
      </div>
     <div>
        <label class="block text-sm font-medium text-gray-700">Total Uang</label>
        <input
          type="number"
          name="total_uang"
          id="edit-total_uang"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="Gaji, Bonus, Lainnya"
          required
        />
      </div>
      <div class="flex justify-end gap-2 pt-4">
        <button
          type="button"
          class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md"
          onclick="document.getElementById('modalForm').classList.add('hidden')"
        >
          Batal
        </button>
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md"
        >
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>