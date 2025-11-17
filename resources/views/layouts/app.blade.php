<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pet Care+')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">
    <nav class="bg-zinc-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold">Pet Care+</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-white text-sm font-medium {{ request()->routeIs('dashboard') ? 'border-white' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('pets.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-white text-sm font-medium {{ request()->routeIs('pets.*') ? 'border-white' : '' }}">
                        Data Hewan
                    </a>
                    <a href="{{ route('owners.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-white text-sm font-medium {{ request()->routeIs('owners.*') ? 'border-white' : '' }}">
                        Pemilik
                    </a>
                    <a href="{{ route('checkups.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-white text-sm font-medium {{ request()->routeIs('checkups.*') ? 'border-white' : '' }}">
                        Pemeriksaan
                    </a>
                </div>
                <button id="mobile-menu-button" class="sm:hidden inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="mobile-menu-icon-open" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="mobile-menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="mobile-menu" class="sm:hidden hidden pb-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-500' : 'hover:bg-blue-500' }}">
                    Dashboard
                </a>
                <a href="{{ route('pets.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('pets.*') ? 'bg-blue-500' : 'hover:bg-blue-500' }}">
                    Data Hewan
                </a>
                <a href="{{ route('owners.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('owners.*') ? 'bg-blue-500' : 'hover:bg-blue-500' }}">
                    Pemilik
                </a>
                <a href="{{ route('checkups.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('checkups.*') ? 'bg-blue-500' : 'hover:bg-blue-500' }}">
                    Pemeriksaan
                </a>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('mobile-menu-icon-open');
        const iconClose = document.getElementById('mobile-menu-icon-close');
        button.addEventListener('click', function () {
            const isHidden = menu.classList.contains('hidden');
            menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden', !isHidden);
            iconClose.classList.toggle('hidden', isHidden);
        });
    });
</script>
</html>
