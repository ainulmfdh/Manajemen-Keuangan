<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <style>
        /* Transisi halus untuk sidebar saat muncul dan hilang */
        .sidebar-mobile {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="relative md:flex bg-gray-50">

        <div class="md:hidden flex justify-end p-5 bg-blue-600 text-white">
            <button id="hamburger-btn" class="focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <aside class="w-64 bg-blue-600 p-4 hidden md:block">
            <div class="mb-8">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="2" x2="12" y2="22" />
                        <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                    </svg>
                </div>
            </div>

            <nav class="space-y-2 mb-8">
                <a href="/dashboard" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                    {{ Request::is('dashboard') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i class="fas fa-home w-5 h-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </nav>

            <div>
                <h4 class="text-xs font-semibold text-gray-200 uppercase tracking-wide mb-4 px-3">
                    TRANSAKSI
                </h4>
                <nav class="space-y-2">
                    <a href="/pendapatan" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                        {{ Request::is('pendapatan') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                        <i class="fas fa-arrow-down w-5 h-5"></i>
                        <span class="font-medium">Pendapatan</span>
                    </a>
                    <a href="/pengeluaran" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                        {{ Request::is('pengeluaran') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                        <i class="fas fa-arrow-up w-5 h-5"></i>
                        <span class="font-medium">Pengeluaran</span>
                    </a>
                    <a href="/karyawan" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                        {{ Request::is('karyawan') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                        <i class="fas fa-users w-5 h-5"></i>
                        <span class="font-medium">Karyawan</span>
                    </a>
                    <a href="/hutang" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                        {{ Request::is('hutang') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                        <i class="fas fa-calendar-alt w-5 h-5"></i>
                        <span class="font-medium">Hutang</span>
                    </a>
                    <a href="/laporan" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                        {{ Request::is('laporan') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                        <i class="fas fa-file-alt w-5 h-5"></i>
                        <span class="font-medium">Laporan</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div id="sidebar-mobile" class="sidebar-mobile fixed inset-y-0 left-0 w-64 bg-blue-600 p-4 transform -translate-x-full md:hidden z-30">
            <div class="flex justify-end mb-4">
                <button id="close-btn" class="focus:outline-none text-white">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <div class="mb-8">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="2" x2="12" y2="22" />
                        <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                    </svg>
                </div>
            </div>

            <nav class="space-y-2 mb-8">
                 <a href="/dashboard" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200
                    {{ Request::is('dashboard') ? 'bg-gray-100 text-blue-600' : 'text-gray-100 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i class="fas fa-home w-5 h-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </nav>
           <div>
                <h4 class="text-xs font-semibold text-gray-200 uppercase tracking-wide mb-4 px-3">
                    TRANSAKSI
                </h4>
                <nav class="space-y-2">
                    <a href="/pendapatan" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200 text-gray-100 hover:bg-gray-100 hover:text-blue-600">
                        <i class="fas fa-arrow-down w-5 h-5"></i>
                        <span class="font-medium">Pendapatan</span>
                    </a>

                    <a href="/pengeluaran" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200 text-gray-100 hover:bg-gray-100 hover:text-blue-600">
                        <i class="fas fa-arrow-up w-5 h-5"></i>
                        <span class="font-medium">Pengeluaran</span>
                    </a>

                    <a href="/karyawan" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200 text-gray-100 hover:bg-gray-100 hover:text-blue-600">
                        <i class="fas fa-users w-5 h-5"></i>
                        <span class="font-medium">Karyawan</span>
                    </a>

                    <a href="/hutang" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200 text-gray-100 hover:bg-gray-100 hover:text-blue-600">
                        <i class="fas fa-calendar-alt w-5 h-5"></i>
                        <span class="font-medium">Hutang</span>
                    </a>

                    <a href="/laporan" class="p-3 rounded-lg flex items-center space-x-3 transition duration-200 text-gray-100 hover:bg-gray-100 hover:text-blue-600">
                        <i class="fas fa-file-alt w-5 h-5"></i>
                        <span class="font-medium">Laporan</span>
                    </a>
                </nav>
            </div>
        </div>
        
      

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const closeBtn = document.getElementById('close-btn');
            const sidebarMobile = document.getElementById('sidebar-mobile');

            // Buka sidebar mobile
            hamburgerBtn.addEventListener('click', () => {
                sidebarMobile.classList.remove('-translate-x-full');
            });

            // Tutup sidebar mobile
            closeBtn.addEventListener('click', () => {
                sidebarMobile.classList.add('-translate-x-full');
            });
        });
    </script>
</body>
</html>