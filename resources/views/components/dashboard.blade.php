<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 grid sm:grid-cols-5 gap-4 border-b border-gray-200">
                <livewire:sidebar-index/>
                <div class="col-span-4">
                  {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>      
</x-app-layout>

