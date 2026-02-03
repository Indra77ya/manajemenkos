<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Lokasi Kos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.branches.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lokasi Kos -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lokasi Kos</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>

                            <!-- Kode Kost -->
                            <div class="mb-4">
                                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Kost</label>
                                <input type="text" name="code" id="code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>

                            <!-- Alamat Kost -->
                            <div class="mb-4 md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Kost</label>
                                <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required></textarea>
                            </div>

                            <!-- Nama Pengurus -->
                            <div class="mb-4">
                                <label for="manager_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pengurus</label>
                                <input type="text" name="manager_name" id="manager_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>

                            <!-- No. HP Pengurus -->
                            <div class="mb-4">
                                <label for="manager_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. HP Pengurus</label>
                                <input type="text" name="manager_phone" id="manager_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Nama Asisten 1 -->
                            <div class="mb-4">
                                <label for="assistant_1_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Asisten 1</label>
                                <input type="text" name="assistant_1_name" id="assistant_1_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Nama Asisten 2 -->
                            <div class="mb-4">
                                <label for="assistant_2_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Asisten 2</label>
                                <input type="text" name="assistant_2_name" id="assistant_2_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Telepon Kost -->
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telepon Kost</label>
                                <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            </div>

                            <!-- Biaya Lokasi -->
                            <div class="mb-4">
                                <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Lokasi</label>
                                <input type="number" step="0.01" name="cost" id="cost" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300" required>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
