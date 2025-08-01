<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Mobile UX/UI Design Course</title>

    <!-- CDN Resources -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Header -->
    <header class="bg-blue-600 w-full text-white p-4 flex items-center justify-between shadow-md">
        <h1 class="text-xl font-semibold">Finance Dashboard</h1>

        <div class="flex items-center space-x-4">
            <!-- Search -->
            <input
                type="text"
                placeholder="Search..."
                class="bg-blue-500 text-white placeholder-white border border-white px-4 py-2 rounded-lg focus:outline-none focus:bg-blue-400 focus:border-white transition-colors duration-200"
            />

            <!-- Notification Icon -->
            <div
                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-400 transition-colors duration-200"
            >
                <i class="fas fa-bell text-white"></i>
            </div>

            <!-- Dropdown Menu -->
            <div class="relative inline-block text-left">
                <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 focus:outline-none transition ease-in-out duration-150"
                    onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                >
                    {{ Auth::user()->name }}
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center ml-2">
                        <img src="/assets/images/default.png" alt="User Avatar" class="rounded-full w-8 h-8" />
                    </div>
                </button>

                <!-- Dropdown Content -->
                <div
                    id="userDropdown"
                    class="hidden absolute right-0 mt-2 w-40 bg-white text-black rounded-md shadow-lg z-10"
                >
                    <x-dropdown-link :href="route('profile.edit')">
                        <i class="fa-solid fa-user text-gray-300 ml-2 mr-2"></i>
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fa-solid fa-right-from-bracket text-gray-300 ml-2 mr-2"></i>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- JS Resources -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
