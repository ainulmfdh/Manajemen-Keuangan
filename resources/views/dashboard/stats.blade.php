<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Dashboard - Manajemen Keuangan</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

  <script>
    function toggleDropdown() {
      document.getElementById('userDropdown').classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 overflow-x-hidden">

  <main class="p-6 bg-gray-50 flex-1 min-h-screen w-full overflow-hidden">
    
    <!-- Stats Cards Atas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <!-- Total Pemasukan -->
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-3xl font-bold text-green-500">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            <p class="text-gray-500 mt-1 text-md font-semibold">Total Pemasukan</p>
          </div>
          <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
            <i class="fas fa-arrow-up text-green-500"></i>
          </div>
        </div>
      </div>

      <!-- Total Pengeluaran -->
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-3xl font-bold text-red-500">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            <p class="text-gray-500 mt-1 text-md font-semibold">Total Pengeluaran</p>
          </div>
          <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
            <i class="fas fa-arrow-down text-red-500"></i>
          </div>
        </div>
      </div>

      <!-- Sisa Uang -->
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-3xl font-bold text-blue-500">Rp {{ number_format($sisaUang, 0, ',', '.') }}</p>
            <p class="text-gray-500 mt-1 text-md font-semibold">Sisa Uang</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fas fa-wallet text-blue-500"></i>
          </div>
        </div>
      </div>

      <!-- Total Hutang -->
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-3xl font-bold text-yellow-500">Rp {{ number_format($totalHutang, 0, ',', '.') }}</p>
            <p class="text-gray-500 mt-1 text-md font-semibold">Total Hutang</p>
          </div>
          <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
            <i class="fas fa-file-invoice-dollar text-yellow-500"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards Bawah dengan border kiri -->
    <div class="mb-5 text-3xl font-bold text-gray-700">
      <p>Statistik <span id="tanggal-hari-ini"></span></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
            <p class="text-gray-500 text-md">Pemasukan hari ini</p>
          </div>
          <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
            <i class="fas fa-arrow-up text-green-500"></i>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($pengeluaranHariIni, 0, ',', '.') }}</p>
            <p class="text-gray-500 text-md">Pengeluaran hari ini</p>
          </div>
          <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
            <i class="fas fa-arrow-down text-red-500"></i>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($hutangHariIni, 0, ',', '.') }}</p>
            <p class="text-gray-500 text-md">Hutang hari ini</p>
          </div>
          <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
            <i class="fas fa-file-invoice-dollar text-yellow-500"></i>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-2xl font-bold text-gray-800">{{ $jumlahKaryawan }}</p>
            <p class="text-gray-500 text-md">Karyawan</p>
          </div>
          <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-users text-blue-500"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
      
      <!-- Bar Chart -->
      <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
          Perbandingan Data Tahun {{ date('Y') }} 
        </h3>
        <canvas id="barChart" width="400" height="200"></canvas>
      </div>

      <!-- Pie Chart -->
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Perbandingan</h3>
        <div class="flex justify-center mt-4 mb-4">
          <canvas id="pieChart" width="200" height="200"></canvas>
        </div>
      </div>
      
    </div>

  </main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // DATE FORMAT
    const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const bulan = [
      "Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const now = new Date();
    const namaHari = hari[now.getDay()];
    const namaBulan = bulan[now.getMonth()];
    const tanggal = now.getDate();
    const tahun = now.getFullYear();

    const hasilFormat = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
    document.getElementById("tanggal-hari-ini").textContent = hasilFormat;


    // PIE CHART PERBANDINGAN PEMASUKAN, PENGELUARAN & SISA UANG
    const pieChart = document.getElementById('pieChart').getContext('2d');
    new Chart(pieChart, {
        type: 'doughnut', 
        data: {
            labels: ['Pemasukan', 'Pengeluaran', 'Sisa Uang'],
            datasets: [{
                data: [
                    {{ $totalPendapatan }},
                    {{ $totalPengeluaran }},
                    {{ $sisaUang }}
                ],
                backgroundColor: [
                    '#22c55e', // green-500
                    '#ef4444', // red-500
                    '#3b82f6'  // blue-500
                ],
                borderColor: '#ffffff', // Putih di antaranya
                borderWidth: 4,
                hoverOffset: 12
            }]
        },
        options: {
            cutout: '65%', // lubang bolong tengah
            responsive: true,
            plugins: {
                legend: {
                    display: false 
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.parsed || 0;
                            return `${label}: Rp${value.toLocaleString('id-ID')}`;
                        }
                    }
                }
            }
        }
    });


  // BAR CHART PERBANDINGAN PENDAPATAN DAN PENGELUARAN
  fetch("{{ route('dashboard.chart-data') }}")
    .then(res => res.json())
    .then(data => {
      const ctx = document.getElementById('barChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [
            {
              label: 'Pendapatan',
              data: data.pendapatan,
              backgroundColor: 'rgba(34,197,94,0.7)',
              borderRadius: 6
            },
            {
              label: 'Pengeluaran',
              data: data.pengeluaran,
              backgroundColor: 'rgba(239,68,68,0.7)',
              borderRadius: 6
            }
          ]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'top' },
            tooltip: {
              callbacks: {
                label: context => `${context.dataset.label}: Rp ${context.raw.toLocaleString('id-ID')}`
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: value => 'Rp ' + value.toLocaleString('id-ID')
              }
            }
          }
        }
      });
    });
  </script>

</body>
</html>
