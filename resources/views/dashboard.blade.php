<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen w-full overflow-hidden">
        <div class="">
          
                @include('dashboard.stats')
        </div>
    </div>
</x-app-layout>
