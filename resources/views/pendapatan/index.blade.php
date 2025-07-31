<x-app-layout>
<div class="w-full max-w-5xl mx-auto">
  <!-- Header dan Tombol Tambah -->
  <div class="flex justify-between items-center mb-4">
    <p class="font-bold text-2xl text-gray-600">DATA PEMASUKAN</p>
    <button
      class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md"
      onclick="document.getElementById('modalForm').classList.remove('hidden')"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Tambah
    </button>
  </div>

  <!-- Include Modal -->
  @include('pendapatan.form-tambah')

  <!-- Tabel Pendapatan -->
  <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="w-full">
      <thead>
        <tr class="bg-blue-500 text-white">
          <th class="px-6 py-4 text-left font-semibold text-lg">No</th>
          <th class="px-6 py-4 text-left font-semibold text-lg">Tanggal</th>
          <th class="px-6 py-4 text-left font-semibold text-lg">Jumlah</th>
          <th class="px-6 py-4 text-left font-semibold text-lg">Kategori</th>
          <th class="px-6 py-4 text-left font-semibold text-lg">Deskripsi</th>
          <th class="px-6 py-4 text-left font-semibold text-lg">Aksi</th>
        </tr>
      </thead>
      <tbody class="font-semibold text-md text-gray-500">
        @forelse ($pendapatans as $index => $pendapatan)
        <tr class="bg-white border-b">
          <td class="px-6 py-4 text-gray-700">{{ $pendapatans->firstItem() + $index }}</td>
          <td class="px-6 py-4 text-gray-700">{{ \Carbon\Carbon::parse($pendapatan->tanggal)->format('d-m-Y') }}</td>
          <td class="px-6 py-4 text-gray-700">Rp {{ number_format($pendapatan->jumlah, 0, ',', '.') }}</td>
          <td class="px-6 py-4 text-gray-700">{{ $pendapatan->kategori }}</td>
          <td class="px-6 py-4 text-gray-700">{{ $pendapatan->deskripsi ?? '-' }}</td>
          <td class="px-6 py-4 text-gray-700">
            <div class="flex gap-2">
              <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-full text-sm px-5 py-2.5">
                <i class="fas fa-edit mr-1"></i> Edit
              </button>
              <button type="button" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-full text-sm px-5 py-2.5">
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
  </div>

  <!-- Pagination -->
  <div class="mt-6 flex justify-center">
    {{ $pendapatans->links() }}
  </div>
</div>

@if (session('success'))
<div id="alert-3" class="fixed top-6 right-6 z-50 flex items-center p-4 mb-4 text-white rounded-lg bg-green-500 animate-slide-in" role="alert">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <div class="ms-3 text-sm font-medium">
    {{ session('success') }}
  </div>
</div>
<script>
  setTimeout(() => {
    document.querySelector('#alert-3')?.remove();
  }, 3000);
</script>
<style>
  @keyframes slide-in {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-slide-in {
    animation: slide-in 0.3s ease-out;
  }
</style>
@endif
</x-app-layout>
