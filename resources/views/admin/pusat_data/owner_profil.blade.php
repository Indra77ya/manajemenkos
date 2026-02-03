<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Owner Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.owner-profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kost -->
                        <div>
                            <label for="nama_kost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kost</label>
                            <input type="text" name="nama_kost" id="nama_kost" value="{{ old('nama_kost', $profile->nama_kost ?? '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            @error('nama_kost') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nama Pemilik -->
                        <div>
                            <label for="nama_pemilik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik', $profile->nama_pemilik ?? '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            @error('nama_pemilik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                         <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $profile->no_telepon ?? '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            @error('no_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $profile->email ?? '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Logo -->
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo</label>
                            @if(isset($profile->logo_path))
                                <div class="mt-2 mb-2">
                                    <img src="{{ asset('storage/' . $profile->logo_path) }}" alt="Current Logo" class="h-20 w-auto rounded border">
                                </div>
                            @endif
                            <input type="file" name="logo" id="logo"
                                   class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-indigo-50 file:text-indigo-700
                                          hover:file:bg-indigo-100">
                            @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded-md hover:bg-sky-700 transition">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
