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
            <p class="text-3xl font-bold text-green-500">Rp 15.000.000</p>
            <p class="text-gray-500 text-sm">Total Pemasukan</p>
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
            <p class="text-3xl font-bold text-red-500">Rp 5.250.000</p>
            <p class="text-gray-500 text-sm">Total Pengeluaran</p>
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
            <p class="text-3xl font-bold text-blue-500">Rp 9.750.000</p>
            <p class="text-gray-500 text-sm">Sisa Uang</p>
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
            <p class="text-3xl font-bold text-yellow-500">Rp 2.500.000</p>
            <p class="text-gray-500 text-sm">Total Hutang</p>
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
            <p class="text-2xl font-bold text-gray-800">1.200.000</p>
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
            <p class="text-2xl font-bold text-gray-800">4.000.000</p>
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
            <p class="text-2xl font-bold text-gray-800">200.000</p>
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
            <p class="text-2xl font-bold text-gray-800">2</p>
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
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
          The number of applied and left students per month
        </h3>
        <div class="flex items-center space-x-4 mb-4">
          <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-orange-400 rounded-full"></div>
            <span class="text-sm text-gray-600">Applied</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
            <span class="text-sm text-gray-600">Left</span>
          </div>
        </div>
        <canvas id="barChart" width="400" height="200"></canvas>
      </div>

      <!-- Pie Chart -->
      <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Students by type of studying</h3>
        <div class="flex justify-center mb-4">
          <canvas id="pieChart" width="200" height="200"></canvas>
        </div>
        <div class="grid grid-cols-3 gap-2 text-sm">
          <div class="flex items-center space-x-2"><div class="w-3 h-3 bg-purple-500 rounded-full"></div><span class="text-gray-600">Red</span></div>
          <div class="flex items-center space-x-2"><div class="w-3 h-3 bg-blue-400 rounded-full"></div><span class="text-gray-600">Blue</span></div>
          <div class="flex items-center space-x-2"><div class="w-3 h-3 bg-yellow-400 rounded-full"></div><span class="text-gray-600">Yellow</span></div>
          <div class="flex items-center space-x-2"><div class="w-3 h-3 bg-green-400 rounded-full"></div><span class="text-gray-600">Green</span></div>
          <div class="flex items-center space-x-2"><div class="w-3 h-3 bg-teal-400 rounded-full"></div><span class="text-gray-600">Purple</span></div>
        </div>
      </div>
    </div>

  </main>


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


    // PIE CHART
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [25, 20, 20, 20, 15],
          backgroundColor: ['#8b5cf6', '#60a5fa', '#fbbf24', '#34d399', '#14b8a6'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        cutout: '60%'
      }
    });
  </script>
</body>
</html>
