<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('admin.branches.index') }}" class="block p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <h3 class="text-lg font-bold">Manage Branches</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">View and manage kost locations.</p>
                        </a>
                        <a href="{{ route('admin.room-types.index') }}" class="block p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <h3 class="text-lg font-bold">Manage Room Types</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Define pricing and types.</p>
                        </a>
                        <a href="{{ route('admin.rooms.index') }}" class="block p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <h3 class="text-lg font-bold">Manage Rooms</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Check room status and details.</p>
                        </a>
                        <a href="{{ route('admin.tenants.index') }}" class="block p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <h3 class="text-lg font-bold">Manage Tenants</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">View and register tenants.</p>
                        </a>
                        <a href="{{ route('admin.leases.index') }}" class="block p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <h3 class="text-lg font-bold">Manage Leases</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Check-in/out and contracts.</p>
                        </a>
                        <a href="{{ route('admin.invoices.index') }}" class="block p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <h3 class="text-lg font-bold">Billing & Invoices</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage payments.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
