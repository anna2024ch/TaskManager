<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4 text-lg font-bold">Willkommen im Task-Management-System</h3>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="p-4 bg-blue-100 rounded">
                            <h4 class="font-bold">Offene Aufgaben</h4>
                            <p class="text-2xl">0</p>
                        </div>

                        <div class="p-4 bg-green-100 rounded">
                            <h4 class="font-bold">Aktive Projekte</h4>
                            <p class="text-2xl">0</p>
                        </div>

                        <div class="p-4 bg-yellow-100 rounded">
                            <h4 class="font-bold">Fällige Aufgaben</h4>
                            <p class="text-2xl">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
