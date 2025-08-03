<x-app-layout>
<div class="w-full max-w-5xl mx-auto">
  <!-- Header dan Tombol Tambah -->
  <div class="flex justify-between items-center mb-4">
    <p class="font-bold text-2xl text-gray-600">DATA LAPORAN</p>
    <button
      class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md"
      onclick="document.getElementById('modalForm').classList.remove('hidden')">
      <i class="fa-solid fa-plus"></i>
      Tambah
    </button>
  </div>

  <!-- Include Modal -->
  @include('laporan.add')
  @include('laporan.edit')
  @include('laporan.delete')

  <!-- Tabel laporan -->
  <div class="bg-white rounded-lg shadow-lg overflow-hidden">
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
  </div>

  <!-- Pagination -->
  <div class="mt-6 flex justify-center">
    {{ $laporans->links() }}
  </div>
</div>

{{-- ALERT SUKSES ADD DATA --}}
@if (session('success'))
<div id="alert-3" class="fixed top-6 right-6 z-50 flex items-center p-4 mb-4 text-white rounded-lg bg-green-500 animate-slide-in" role="alert">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <div class="ms-3 text-sm font-medium">
    {{ session('success') }}
  </div>
</div>

{{-- ALERT SUCCES DELETE DATA --}}
<div id="alert-delete-success" class="fixed top-6 right-6 z-50 flex items-center p-4 mb-4 text-white rounded-lg bg-green-500 animate-slide-in hidden" role="alert">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <div class="ms-3 text-sm font-medium">
    Data berhasil dihapus!
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


{{-- GET DATA PEMASUKAN UTK EDIT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalFormEdit');
    const editForm = document.getElementById('editlaporanForm');
    const editButtons = document.querySelectorAll('.edit-button');

    // Fungsi untuk membuka modal dan mengisi data
    const openEditModal = (id) => {
        fetch(`/laporan/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('edit-nama').value = data.nama;
                document.getElementById('edit-bulan').value = data.bulan;
                document.getElementById('edit-jumlah_transaksi').value = data.jumlah_transaksi;
                document.getElementById('edit-total_uang').value = data.total_uang;
                editForm.action = `/laporan/${id}`;
                modal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Tidak dapat memuat data untuk diedit.');
            });
    };

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const laporanId = this.getAttribute('data-id');
            openEditModal(laporanId);
        });
    });

    // Tutup modal jika tombol batal diklik
    const cancelButton = modal.querySelector('button[type="button"]');
    cancelButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });


// DELETE DATA PEMASUKAN (AJAX, TANPA RELOAD)
    const deleteModal = document.getElementById('modalDelete');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    let deleteId = null;

    // Buka modal ketika tombol hapus di klik
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            deleteId = this.getAttribute('data-id');
            deleteModal.classList.remove('hidden');
        });
    });

    // Tutup modal
    deleteModal.querySelector('.btn-cancel').addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        deleteId = null;
    });

    // Konfirmasi hapus
    confirmDeleteBtn.addEventListener('click', function () {
        if (!deleteId) return;
        fetch(`/laporan/${deleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Tampilkan alert sukses hapus
                const alert = document.getElementById('alert-delete-success');
                alert.classList.remove('hidden');

                // Hapus elemen baris data dari DOM tanpa reload
                const row = document.querySelector(`[data-row-id="${deleteId}"]`);
                if (row) row.remove();

                // Sembunyikan modal dan alert setelah 2 detik
                setTimeout(() => {
                    alert.classList.add('hidden');
                    deleteModal.classList.add('hidden');
                    deleteId = null;
                }, 2000);
            } else {
                alert('Gagal menghapus data.');
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan.');
            console.error(error);
        });
    });
});

</script>
</x-app-layout>
