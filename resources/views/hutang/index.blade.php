<x-app-layout>
<div class="w-full max-w-5xl mx-auto">
  <!-- Header dan Tombol Tambah -->
 <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-3 gap-4">
  <!-- Judul -->
  <p class="font-bold text-2xl text-gray-700">DATA HUTANG</p>

  <!-- Form Pencarian -->
    <form id="searchForm" class="relative w-full md:w-1/2">
      <label for="search" class="sr-only">Cari</label>
      <div class="relative">
        <!-- Icon Search (kiri) -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>

        <!-- Input Search -->
        <input
          type="search"
          name="q"
          id="search"
          class="block w-full pl-10 pr-10 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
          placeholder="Cari pemasukan...">

      </div>
    </form>


  <!-- Tombol Tambah -->
  <button
    class="w-full md:w-auto flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md"
    onclick="document.getElementById('modalForm').classList.remove('hidden')">
    <i class="fa-solid fa-plus"></i>
    Tambah
  </button>
</div>

  <!-- Include Modal -->
  @include('hutang.add')
  @include('hutang.edit')
  @include('hutang.delete')

  <!-- Tabel hutang -->
 <div id="tableContainer" class="bg-white rounded-lg shadow-lg overflow-hidden">
     @include('hutang.table')
  </div>

  <!-- Pagination -->
  <div class="mt-6 flex justify-center">
    {{ $hutangs->links() }}
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
    const editForm = document.getElementById('edithutangForm');
    const editButtons = document.querySelectorAll('.edit-button');

    // Fungsi untuk membuka modal dan mengisi data
    const openEditModal = (id) => {
        fetch(`/hutang/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('edit-tanggal').value = data.tanggal.split(' ')[0];
                document.getElementById('edit-jumlah').value = data.jumlah;
                document.getElementById('edit-alasan').value = data.alasan;
                document.getElementById('edit-penghutang').value = data.penghutang;
                editForm.action = `/hutang/${id}`;
                modal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Tidak dapat memuat data untuk diedit.');
            });
    };

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const hutangId = this.getAttribute('data-id');
            openEditModal(hutangId);
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
        fetch(`/hutang/${deleteId}`, {
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

    // LIVE SEARCH
    const searchInput = document.getElementById('search');
    const tableContainer = document.getElementById('tableContainer');

    if (!searchInput || !tableContainer) {
      console.error('Elemen tidak ditemukan. Pastikan ada ID #search dan #tableContainer.');
      return;
    }

    // Cegah reload jika masih dalam form
    searchInput.form.addEventListener('submit', function (e) {
      e.preventDefault();
    });

    searchInput.addEventListener('input', function () {
      const query = this.value;

      fetch(`?q=${query}`, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.text())
      .then(data => {
        tableContainer.innerHTML = data;
      })
      .catch(error => console.error('Live Search Error:', error));
    });
});

</script>
</x-app-layout>
