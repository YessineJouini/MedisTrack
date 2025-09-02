<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div id="app">
        <!-- Navbar -->
        <nav class="bg-white shadow-md sticky top-0 z-50000">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Agent links -->
           <div class="flex items-center space-x-4">
    {{-- Agent-only links --}}
    @if(Auth::check() && Auth::user()->role === 'Agent')
        <a href="{{ route('agent.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-1">
            <i class="fas fa-ticket-alt"></i> Tickets
        </a>
        <a href="{{ route('stock.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-1">
            <i class="fas fa-boxes"></i> Stocks
        </a>
    @endif

    {{-- 🔔 Bell visible for both Admin + Agent --}}
    @if(Auth::check() && in_array(strtolower(Auth::user()->role), ['agent', 'admin']))
        <div class="relative inline-block text-left">
            <button id="notifButton" class="inline-flex items-center space-x-1 focus:outline-none">
                <i class="fas fa-bell fa-lg"></i>
                @php
                    $unread = Auth::user()->unreadNotifications->count();
                @endphp
                @if($unread > 0)
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full">
                        {{ $unread }}
                    </span>
                @endif
            </button>

            <!-- Dropdown -->
            <div id="notifDropdown"
                 class="origin-top-right absolute right-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                <div class="py-1 max-h-80 overflow-y-auto">
                    @forelse(Auth::user()->notifications->take(10) as $notif)
                        <a href="#"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $notif->read_at ? '' : 'font-bold' }}">
                            {{ $notif->data['message'] ?? 'Nouvelle notification' }}
                            <br>
                            <small class="text-xs text-gray-400">{{ $notif->created_at->diffForHumans() }}</small>
                        </a>
                    @empty
                        <p class="px-4 py-2 text-sm text-gray-500">Aucune notification</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</div>


            <!-- Center / Logo -->
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600 flex items-center gap-2">
                    <i class="fas fa-home"></i> {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <!-- Right: Profile & Logout -->
            <div class="flex items-center space-x-2">
                @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200 transition gap-2">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition gap-2">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</nav>


        <!-- Main content -->
        <div class="min-h-screen flex">
            @if(Auth::check() && in_array(Auth::user()->role, ['Admin', 'admin', 'Administrateur', 'administrateur']))
                <aside id="adminSidebar" class="w-64 bg-white text-gray-800 border-r border-gray-200 shadow-sm hidden md:flex flex-col transition-transform">
                    <div class="p-4 text-lg font-semibold flex items-center gap-2 border-b border-gray-100">
                        <img src="{{ asset('images/medis_logo.png') }}" alt="Logo" class="h-6 w-6">
                        <span class="text-indigo-600">Admin Panel</span>
                    </div>
                    <nav class="flex-1 p-4 space-y-2">
                        <a href="{{ route('admin.stock.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50 hover:text-indigo-600 transition">
                            <i class="fas fa-box w-4"></i>
                            <span>Articles</span>
                        </a>
                        <a href="{{ route('admin.factures.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50 hover:text-indigo-600 transition">
                            <i class="fa-solid fa-ticket"></i>
                            <span>facture</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50 hover:text-indigo-600 transition">
                            <i class="fas fa-users w-4"></i>
                            <span>Utilisateurs</span>
                        </a>
                        <a href="{{ route('agent.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50 hover:text-indigo-600 transition">
                            <i class="fas fa-ticket-alt w-4"></i>
                            <span>Tickets</span>
                        </a>
                           <a href="{{ route('admin.admin.dashboard') }}" class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50 hover:text-indigo-600 transition">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span>Statistiques</span>
                        </a>
                        
                    </nav>
                    <div class="p-4 border-t border-gray-100">
                        <a href="#" class="flex items-center gap-3 text-red-500 hover:bg-red-50 p-2 rounded" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                            <i class="fas fa-sign-out-alt w-4"></i>
                            <span>Logout</span>
                        </a>
                        <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    </div>
                </aside>
            @endif

            <main class="flex-1 py-6">
                @if (session('success'))
    <div class="max-w-4xl mx-auto my-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700 flex items-center gap-2">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
<script>
    const button = document.getElementById('notifButton');
    const dropdown = document.getElementById('notifDropdown');

    button.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    // Optional: click outside to close
    window.addEventListener('click', (e) => {
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
</html>
