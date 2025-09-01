<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- Sidebar + Topbar --}}
    <div class="flex h-screen">
        
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-4 text-xl font-bold border-b border-gray-700">
                Admin Panel
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.stock.index') }}" class="block p-2 rounded hover:bg-gray-700">Articles</a>
                <a href="{{ route('users.index') }}" class="block p-2 rounded hover:bg-gray-700">Utilisateurs</a>
                <a href="{{ route('agent.index') }}" class="block p-2 rounded hover:bg-gray-700">Tickets</a>
                <a href="{{ route('logout') }}" class="block p-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
            </nav>
        </aside>

        {{-- Content --}}
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">@yield('title')</h1>
            
            {{-- Flash messages --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
