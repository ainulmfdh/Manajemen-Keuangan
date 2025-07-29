<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mobile UX/UI Design Course</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-50 p-4">
           <div class="">
    <!-- Logo -->
    <div class="mb-8">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
            <!-- DollarSign Icon (lucide-style) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="2" x2="12" y2="22" />
                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
            </svg>
        </div>
    </div>

    <!-- Menu Utama -->
    <nav class="space-y-2 mb-8">
        <a href="/dashboard" class="p-3 rounded-lg flex items-center space-x-3 text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200">
            <!-- Home Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
                <path d="M9 21V12h6v9" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>
    </nav>

    <!-- Transaksi Section -->
    <div>
        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4 px-3">
            TRANSAKSI
        </h4>

        <nav class="space-y-2">
            <!-- Pendapatan -->
            <a href="/pendapatan" class="p-3 rounded-lg flex items-center space-x-3 text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200">
                <!-- BanknoteArrowUp Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 12h12M12 6v12M12 18l-3-3M12 18l3-3" transform="rotate(90 12 12)" />
                </svg>
                <span class="font-medium">Pendapatan</span>
            </a>

            <!-- Pengeluaran -->
            <a href="/pengeluaran" class="p-3 rounded-lg flex items-center space-x-3 text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200">
                <!-- BanknoteArrowDown Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 12h12M12 18V6M12 6l-3 3M12 6l3 3" transform="rotate(90 12 12)" />
                </svg>
                <span class="font-medium">Pengeluaran</span>
            </a>

            <!-- Karyawan -->
            <a href="/karyawan" class="p-3 rounded-lg flex items-center space-x-3 text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200">
                <!-- Users Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <span class="font-medium">Karyawan</span>
            </a>

            <!-- Hutang -->
            <a href="/hutang" class="p-3 rounded-lg flex items-center space-x-3 text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200">
                <!-- CalendarArrowDown Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                    <path d="M12 18V12M9 15l3 3 3-3"></path>
                </svg>
                <span class="font-medium">Hutang</span>
            </a>

            <!-- Laporan -->
            <a href="/laporan" class="p-3 rounded-lg flex items-center space-x-3 text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200">
                <!-- FileCheck Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                    <polyline points="14 2 14 8 20 8" />
                    <path d="M9 14l2 2 4-4" />
                </svg>
                <span class="font-medium">Laporan</span>
            </a>
        </nav>
    </div>
</div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-blue-600 text-white p-4 flex items-center justify-between shadow-md">
                <h1 class="text-xl font-semibold">Finance Dashboard</h1>

                <div class="flex items-center space-x-4">
                    <input
                        type="text"
                        placeholder="Search..."
                        class="bg-blue-500 text-white placeholder-white border border-white px-4 py-2 rounded-lg focus:outline-none focus:bg-blue-400 focus:border-white transition-colors duration-200"
                    />

                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-400 transition-colors duration-200">
                        <i class="fas fa-bell text-white"></i>
                    </div>

                    <!-- Dropdown -->
                    <div class="relative inline-block text-left">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 focus:outline-none transition ease-in-out duration-150"
                            onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                        >
                            Nama User
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center ml-2">
                                <img src="/assets/images/default.png" alt="" class="rounded-full w-8 h-8" />
                            </div>
                        </button>

                        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white text-black rounded-md shadow-lg z-10">
                            <a href="/profile" class="block px-4 py-2 text-sm hover:bg-gray-100 text-gray-800">Profile</a>
                            <form method="POST" action="/logout">
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-gray-800">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten Halaman -->
            <main class="p-6">
                <p class="text-gray-700">Selamat datang di Dashboard!</p>
            </main>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</html>
