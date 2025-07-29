<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mobile UX/UI Design Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-full w-16 bg-gray-800 flex flex-col items-center py-4 space-y-6">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
            <i class="fas fa-check text-white text-sm"></i>
        </div>
        <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white cursor-pointer">
            <i class="fas fa-chart-bar"></i>
        </div>
        <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white cursor-pointer">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white cursor-pointer">
            <i class="fas fa-folder"></i>
        </div>
        <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white cursor-pointer">
            <i class="fas fa-cog"></i>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-16 min-h-screen">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-search text-gray-400"></i>
                    <input type="text" placeholder="Search" class="border-none outline-none text-gray-600">
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 font-medium">Dhaiflash</span>
                    <span class="text-gray-500 text-sm">Lecturer</span>
                    <div class="w-8 h-8 bg-orange-400 rounded-full"></div>
                    <i class="fas fa-bell text-gray-400"></i>
                    <i class="fas fa-comments text-gray-400"></i>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-6">
            <!-- Dashboard Title -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                    <p class="text-gray-500">Mobile UX/UI Design Course</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                        <i class="fas fa-edit"></i>
                        <span>Manage Dashboard</span>
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Create New Course</span>
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">62</p>
                            <p class="text-gray-500">Students</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-purple-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">6.8</p>
                            <p class="text-gray-500">Average mark</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-green-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">9 <span class="text-lg text-gray-500">(14%)</span></p>
                            <p class="text-gray-500">Underperforming students</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line-down text-red-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">92%</p>
                            <p class="text-gray-500">Finished homeworks</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clipboard-check text-blue-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Bar Chart -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">The number of applied and left students per month</h3>
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
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <span class="text-gray-600">Red</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                            <span class="text-gray-600">Blue</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                            <span class="text-gray-600">Yellow</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            <span class="text-gray-600">Green</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-teal-400 rounded-full"></div>
                            <span class="text-gray-600">Purple</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Students List -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Students by average mark</h3>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option>Descending</option>
                            <option>Ascending</option>
                        </select>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-red-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Annette Watson</span>
                            </div>
                            <span class="text-gray-800 font-semibold">9.3</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Calvin Steward</span>
                            </div>
                            <span class="text-gray-800 font-semibold">8.3</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Ralph Richards</span>
                            </div>
                            <span class="text-gray-800 font-semibold">8.9</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Bernard Murphy</span>
                            </div>
                            <span class="text-gray-800 font-semibold">8.2</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Arlene Robertson</span>
                            </div>
                            <span class="text-gray-800 font-semibold">7.8</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Jane Lane</span>
                            </div>
                            <span class="text-gray-800 font-semibold">9.2</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-600 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Pat Mckinney</span>
                            </div>
                            <span class="text-gray-800 font-semibold">6.9</span>
                        </div>
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-teal-400 rounded-full"></div>
                                <span class="text-gray-800 font-medium">Norman Walters</span>
                            </div>
                            <span class="text-gray-800 font-semibold">9.9</span>
                        </div>
                    </div>
                </div>

                <!-- Additional Stats -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl font-bold text-gray-800">25</p>
                                <p class="text-gray-500">Lections left</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-yellow-500"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl font-bold text-gray-800">139</p>
                                <p class="text-gray-500">Hours spent on lections</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-blue-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bar Chart
        // const barCtx = document.getElementById('barChart').getContext('2d');
        // new Chart(barCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        //         datasets: [{
        //             label: 'Applied',
        //             data: [18, 15, 24, 8, 11, 10, 17, 19, 18, 20, 18, 17],
        //             backgroundColor: '#fb923c',
        //             borderRadius: 4
        //         }, {
        //             label: 'Left',
        //             data: [16, 15, 8, 14, 7, 6, 15, 19, 12, 20, 8, 12],
        //             backgroundColor: '#3b82f6',
        //             borderRadius: 4
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 display: false
        //             }
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true,
        //                 max: 25,
        //                 grid: {
        //                     borderDash: [2, 2]
        //                 }
        //             },
        //             x: {
        //                 grid: {
        //                     display: false
        //                 }
        //             }
        //         }
        //     }
        // });

        // Pie Chart
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
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '60%'
            }
        });
    </script>
</body>
</html>