<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Lokasi Kos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div x-data="{
                        cost_wifi: {{ $branch->cost_wifi ?? 0 }},
                        cost_water: {{ $branch->cost_water ?? 0 }},
                        cost_electricity: {{ $branch->cost_electricity ?? 0 }},
                        cost_other: {{ $branch->cost_other ?? 0 }},
                        get total() {
                            return (parseFloat(this.cost_wifi) || 0) +
                                   (parseFloat(this.cost_water) || 0) +
                                   (parseFloat(this.cost_electricity) || 0) +
                                   (parseFloat(this.cost_other) || 0);
                        }
                    }">
                    <form action="{{ route('admin.branches.update', $branch) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lokasi Kos -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lokasi Kos</label>
                                <input type="text" name="name" id="name" value="{{ $branch->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>

                            <!-- Kode Kost -->
                            <div class="mb-4">
                                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Kost</label>
                                <input type="text" name="code" id="code" value="{{ $branch->code }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>

                            <!-- Alamat Kost -->
                            <div class="mb-4 md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Kost</label>
                                <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>{{ $branch->address }}</textarea>
                            </div>

                            <!-- Nama Pengurus -->
                            <div class="mb-4">
                                <label for="manager_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pengurus</label>
                                <input type="text" name="manager_name" id="manager_name" value="{{ $branch->manager_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>

                            <!-- No. HP Pengurus -->
                            <div class="mb-4">
                                <label for="manager_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. HP Pengurus</label>
                                <input type="text" name="manager_phone" id="manager_phone" value="{{ $branch->manager_phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Nama Asisten 1 -->
                            <div class="mb-4">
                                <label for="assistant_1_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Asisten 1</label>
                                <input type="text" name="assistant_1_name" id="assistant_1_name" value="{{ $branch->assistant_1_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Nama Asisten 2 -->
                            <div class="mb-4">
                                <label for="assistant_2_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Asisten 2</label>
                                <input type="text" name="assistant_2_name" id="assistant_2_name" value="{{ $branch->assistant_2_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Telepon Kost -->
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telepon Kost</label>
                                <input type="text" name="phone" id="phone" value="{{ $branch->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Biaya Operasional Section -->
                            <div class="md:col-span-2 border-t pt-4 mt-2">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Rincian Biaya Operasional (Bulanan)</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="mb-4">
                                        <label for="cost_wifi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya WiFi</label>
                                        <input type="number" name="cost_wifi" id="cost_wifi" x-model="cost_wifi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="cost_water" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Air</label>
                                        <input type="number" name="cost_water" id="cost_water" x-model="cost_water" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="cost_electricity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Listrik</label>
                                        <input type="number" name="cost_electricity" id="cost_electricity" x-model="cost_electricity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="cost_other" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Lainnya</label>
                                        <input type="number" name="cost_other" id="cost_other" x-model="cost_other" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                    </div>
                                </div>
                            </div>

                            <!-- Total Biaya Lokasi -->
                            <div class="mb-4 md:col-span-2">
                                <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Biaya Lokasi (Otomatis)</label>
                                <input type="number" name="cost" id="cost" x-model="total" readonly class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 cursor-not-allowed text-gray-500">
                                <p class="text-sm text-gray-500 mt-1">Total dihitung otomatis dari rincian biaya operasional.</p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Perbarui</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
