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
        <nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Agent links -->
            <div class="flex items-center space-x-4">
                @if(Auth::check() && Auth::user()->role === 'Agent')
                    <a href="{{ route('agent.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-1">
                        <i class="fas fa-ticket-alt"></i> Tickets
                    </a>
                    <a href="{{ route('stock.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-1">
                        <i class="fas fa-boxes"></i> Stocks
                    </a>
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
        <main class="py-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
