<!-- form-edit -->
<div id="modalFormEdit" class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 space-y-4">
    <h2 class="text-2xl font-bold text-gray-700">Ubah Data Hutang</h2>
    <form id="edithutangForm" method="POST" class="space-y-4">
        @csrf
            {{-- Untuk method PUT/PATCH, Laravel butuh method spoofing --}}
            @method('POST')
      <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
        <input
          type="date"
          id="edit-tanggal"
          name="tanggal"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Jumlah</label>
        <input
          type="number"
          name="jumlah"
          id="edit-jumlah"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Alasan</label>
        <input
          type="text"
          name="alasan"
          id="edit-alasan"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="Kebutuhan, Bayar Sekolah, Lainnya"
          required
        />
      </div>
     <div>
        <label class="block text-sm font-medium text-gray-700">Penghutang</label>
        <input
          type="text"
          name="penghutang"
          id="edit-penghutang"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="Samuel"
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