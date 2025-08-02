<x-app-layout>
<div class="w-full max-w-5xl mx-auto">
  <!-- Header dan Tombol Tambah -->
  <div class="flex justify-between items-center mb-4">
    <p class="font-bold text-2xl text-gray-600">DATA PENGELUARAN</p>
    <button
      class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md"
      onclick="document.getElementById('modalForm').classList.remove('hidden')">
      <i class="fa-solid fa-plus"></i>
      Tambah
    </button>
  </div>

  <!-- Include Modal -->
  @include('pengeluaran.add')
  @include('pengeluaran.edit')
  @include('pengeluaran.delete')

  <!-- Tabel pengeluaran -->
  <div class="bg-white rounded-lg shadow-lg overflow-hidden">
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
  </div>

  <!-- Pagination -->
  <div class="mt-6 flex justify-center">
    {{ $pengeluarans->links() }}
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
    const editForm = document.getElementById('editpengeluaranForm');
    const editButtons = document.querySelectorAll('.edit-button');

    // Fungsi untuk membuka modal dan mengisi data
    const openEditModal = (id) => {
        fetch(`/pengeluaran/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('edit-tanggal').value = data.tanggal.split(' ')[0];
                document.getElementById('edit-jumlah').value = data.jumlah;
                document.getElementById('edit-kategori').value = data.kategori;
                document.getElementById('edit-deskripsi').value = data.deskripsi;
                editForm.action = `/pengeluaran/${id}`;
                modal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Tidak dapat memuat data untuk diedit.');
            });
    };

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const pengeluaranId = this.getAttribute('data-id');
            openEditModal(pengeluaranId);
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
        fetch(`/pengeluaran/${deleteId}`, {
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
