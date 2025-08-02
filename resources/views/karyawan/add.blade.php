<!-- form-tambah -->
<div id="modalForm" class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 space-y-4">
    <h2 class="text-2xl font-bold text-gray-700">Tambah Data Karyawan</h2>
    <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-4">
        @csrf
      
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input
          type="text"
          name="nama"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
           placeholder="Fanny"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Posisi</label>
        <input
          type="text"
          name="posisi"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="Sekretaris"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Alamat</label>
        <input
          type="text"
          name="alamat"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="Jl Ahmad Yani"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Umur</label>
        <input
          type="number"
          name="umur"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="20"
          required
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Kontak</label>
        <input
          type="text"
          name="kontak"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          placeholder="0897862753"
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

