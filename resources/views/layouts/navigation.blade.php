<nav x-data="{ open: false }" class="bg-gray-100">
    <!-- Top Bar (Blue) -->
    <div class="bg-sky-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-12">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xl font-semibold tracking-wide hover:text-gray-100">
                            SIMKOS
                        </a>
                    </div>

                    <!-- Top Menu Items -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                        <!-- Pusat Data Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                            <div @click="open = ! open">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:bg-sky-700 focus:outline-none transition ease-in-out duration-150">
                                    <i class="mr-2">
                                        <!-- Gear Icon -->
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                    </i>
                                    <div>Pusat Data</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <div x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute z-50 mt-2 w-56 rounded-md shadow-lg ltr:origin-top-left rtl:origin-top-right start-0"
                                    style="display: none;"
                                    @click="open = false">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    @php
                                        $pusatDataLinks = [
                                            ['label' => 'Owner Profil', 'route' => 'admin.owner-profil'],
                                            ['label' => 'Pengguna', 'route' => 'admin.pengguna'],
                                            ['label' => 'Lokasi Kos', 'route' => 'admin.branches.index'], // Use actual resource
                                            ['label' => 'E-mail Setting', 'route' => 'admin.email-setting'],
                                            ['label' => 'Kamar', 'route' => 'admin.rooms.index'], // Use actual resource
                                            ['label' => 'Login Penghuni', 'route' => 'admin.login-penghuni'],
                                            ['label' => 'Denda', 'route' => 'admin.denda'],
                                            ['label' => 'Info Rekening', 'route' => 'admin.info-rekening'],
                                            ['label' => 'Setting Pernyataan', 'route' => 'admin.setting-pernyataan'],
                                            ['label' => 'Variabel Kwh PLN', 'route' => 'admin.variabel-kwh-pln'],
                                            ['label' => 'Biaya Tambahan Kamar', 'route' => 'admin.biaya-tambahan-kamar'],
                                            ['label' => 'Jenis Pengeluaran Rutin', 'route' => 'admin.jenis-pengeluaran-rutin'],
                                        ];
                                    @endphp
                                    @foreach($pusatDataLinks as $link)
                                        <x-dropdown-link :href="Route::has($link['route']) ? route($link['route']) : '#'" class="flex items-center">
                                            <!-- Small triangle icon -->
                                            <svg class="w-2 h-2 mr-2 text-gray-400" viewBox="0 0 8 8" fill="currentColor">
                                                <path d="M0 0l4 4 4-4H0z" transform="rotate(-90 4 4)" />
                                            </svg>
                                            {{ $link['label'] }}
                                        </x-dropdown-link>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Pesan Dropdown -->
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:bg-sky-700 focus:outline-none transition ease-in-out duration-150">
                                    <i class="mr-2">
                                        <!-- Envelope Icon -->
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                                    </i>
                                    <div>Pesan</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#">Inbox</x-dropdown-link>
                                <x-dropdown-link href="#">Sent</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <!-- EULA Link -->
                        <a href="#" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:bg-sky-700 focus:outline-none transition ease-in-out duration-150">
                            <i class="mr-2">
                                <!-- Gavel/Hammer Icon -->
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5zM5 13a.5.5 0 01.5.5v2.293c0 .133.053.26.146.353l3 3a.5.5 0 00.708 0l3-3a.5.5 0 00.146-.353V13.5a.5.5 0 011 0v2.293l-3.646 3.647a.5.5 0 01-.708 0L5.5 15.793V13.5a.5.5 0 01-.5-.5z" clip-rule="evenodd"/></svg>
                            </i>
                            EULA
                        </a>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    <!-- Notification Bell -->
                    <button class="relative p-1 text-white hover:text-gray-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 block h-4 w-6 rounded-full ring-2 ring-white bg-red-600 text-xs text-white text-center leading-4">167</span>
                    </button>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:bg-sky-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center">
                                    <div class="mr-2 text-right">
                                        <div class="text-xs opacity-75">Welcome,</div>
                                        <div>{{ Auth::user()->name }}</div>
                                    </div>
                                    <!-- Avatar Placeholder -->
                                    <div class="h-8 w-8 rounded-full bg-gray-300 overflow-hidden">
                                        <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-sky-700 focus:outline-none focus:bg-sky-700 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Bar (White) -->
    <div class="bg-white border-b border-gray-200 shadow-sm hidden sm:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-0">
                @php
                    $navLinks = [
                        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'active_check' => ['dashboard', 'admin.dashboard', 'tenant.dashboard']],
                    ];

                    if (Auth::user()->role === 'admin') {
                        $navLinks = array_merge($navLinks, [
                            ['route' => 'admin.pendaftaran', 'label' => 'Pendaftaran', 'icon' => 'M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z'],
                            ['route' => 'admin.pembayaran', 'label' => 'Pembayaran', 'icon' => 'M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z M2 8v8a2 2 0 002 2h12a2 2 0 002-2V8H2z'],
                            ['route' => 'admin.pemasukan-lain', 'label' => 'Pemasukan Lain', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['route' => 'admin.pengeluaran', 'label' => 'Pengeluaran', 'icon' => 'M4 4h16v16H4V4z'],
                            ['route' => 'admin.laporan', 'label' => 'Laporan', 'icon' => 'M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0 1 1 0 002 0zM7 8a1 1 0 012 0v5a1 1 0 11-2 0V8zm5-1a1 1 0 11-2 0 1 1 0 012 0zm1 2a1 1 0 100 2 1 1 0 000-2z'],
                        ]);
                    }
                @endphp

                @foreach($navLinks as $link)
                    @if(Route::has($link['route']) || ($link['route'] === 'admin.pendaftaran' && Auth::user()->role === 'admin'))
                        @php
                            $isActive = request()->routeIs($link['route']);
                            if (isset($link['active_check'])) {
                                $isActive = request()->routeIs($link['active_check']);
                            }

                            // Special handling for Dropdowns
                            $isDropdown = in_array($link['route'], ['admin.pendaftaran', 'admin.pembayaran']);
                        @endphp

                        @if($isDropdown)
                            <div class="relative flex flex-col items-center justify-center border-r border-gray-100 min-w-[100px] group" x-data="{ open: false }" @click.outside="open = false" @mouseleave="open = false">
                                <button @click="open = ! open" class="flex flex-col items-center justify-center px-4 py-3 w-full h-full focus:outline-none transition duration-150 ease-in-out {{ $isActive ? 'text-sky-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                                    <div class="mb-1">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="{{ $link['icon'] }}" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="text-sm font-medium">{{ $link['label'] }}</div>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute top-full left-0 z-50 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 origin-top-left"
                                     style="display: none;">
                                    <div class="py-1">
                                        @if($link['route'] === 'admin.pendaftaran')
                                            <a href="{{ route('admin.pendaftaran.entri') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Entri</a>
                                            <a href="{{ route('admin.pendaftaran.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Edit</a>
                                            <a href="{{ route('admin.pendaftaran.pindah-kamar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Pindah Kamar</a>
                                        @elseif($link['route'] === 'admin.pembayaran')
                                            <a href="{{ route('admin.pembayaran.entri') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Entri</a>
                                            <a href="{{ route('admin.pembayaran.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Edit</a>
                                            <a href="{{ route('admin.pembayaran.deposit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Deposit</a>
                                            <a href="{{ route('admin.pembayaran.konfirmasi-bayar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Konfirmasi bayar</a>
                                            <a href="{{ route('admin.pembayaran.check-out') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">Check Out</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route($link['route']) }}"
                               class="flex flex-col items-center justify-center px-4 py-3 border-r border-gray-100 min-w-[100px] group transition duration-150 ease-in-out
                               {{ $isActive ? 'text-sky-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                                <div class="mb-1">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" d="{{ $link['icon'] }}" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium">{{ $link['label'] }}</div>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.pendaftaran')" :active="request()->routeIs('admin.pendaftaran')">
                    {{ __('Pendaftaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pembayaran')" :active="request()->routeIs('admin.pembayaran')">
                    {{ __('Pembayaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pemasukan-lain')" :active="request()->routeIs('admin.pemasukan-lain')">
                    {{ __('Pemasukan Lain') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pengeluaran')" :active="request()->routeIs('admin.pengeluaran')">
                    {{ __('Pengeluaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.laporan')" :active="request()->routeIs('admin.laporan')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
