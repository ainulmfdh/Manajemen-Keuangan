<!-- form-tambah -->
<div id="modalForm" class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 space-y-4">
    <h2 class="text-2xl font-bold text-gray-700">Tambah Data Laporan</h2>
    <form action="{{ route('laporan.store') }}" method="POST" class="space-y-4">
        @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <select name="nama" id="nama" onchange="ambilDataTransaksi()" class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2">
            <option value="" disabled selected>Pilih Jenis</option>
            <option value="pendapatan">Pendapatan</option>
            <option value="pengeluaran">Pengeluaran</option>
            <option value="hutang">Hutang</option>
        </select>

      </div>

      <!-- Filter per bulan -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Bulan</label>
        <input
          type="month"
          name="bulan"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          required
          onchange="ambilDataTransaksi()"
        />
      </div>

      {{-- <div>
        <label class="block text-sm font-medium text-gray-700">Jumlah Transaksi</label>
        <input
          type="number"
          id="jumlah_transaksi"
          name="jumlah_transaksi"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          readonly
        />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Total Uang</label>
        <input
          type="number"
          id="total_uang"
          name="total_uang"
          class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
          readonly
        />
      </div> --}}

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

<script>
function ambilDataTransaksi() {
    const jenis = document.getElementById('nama').value;
    const bulan = document.querySelector('input[name="bulan"]').value;

    // if (!bulan) {
    //     alert("Silakan pilih bulan terlebih dahulu.");
    //     return;
    // }

    fetch(`/laporan/hitung-transaksi?jenis=${jenis}&bulan=${bulan}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('jumlah_transaksi').value = data.jumlah;
            document.getElementById('total_uang').value = data.total;
        })
        .catch(error => {
            console.error('Gagal mengambil data:', error);
        });
}

</script>
