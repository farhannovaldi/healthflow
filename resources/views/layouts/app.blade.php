<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HealthFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-indigo-100 to-blue-200 min-h-screen font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gradient-to-r from-indigo-700 to-blue-800 p-6 text-white">
            <h2 class="text-3xl font-bold text-center mb-8">Dashboard</h2>
            <ul class="space-y-4">
                <li><a href="{{ route('data.pasien') }}" class="block py-2 px-4 rounded hover:bg-indigo-600">Data Pasien</a></li>
                <li><a href="{{ route('data.dokter') }}" class="block py-2 px-4 rounded hover:bg-indigo-600">Data Dokter</a></li>
                <li><a href="{{ route('jadwal.dokter') }}" class="block py-2 px-4 rounded hover:bg-indigo-600">Jadwal Dokter</a></li>
                <li><a href="{{ route('data.obat') }}" class="block py-2 px-4 rounded hover:bg-indigo-600">Data Obat</a></li>
                <li><a href="{{ route('history.pasien') }}" class="block py-2 px-4 rounded hover:bg-indigo-600">History Pasien</a></li>
                <li><a href="{{ route('logout') }}" class="block py-2 px-4 rounded bg-red-500 hover:bg-red-600">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-8 bg-gradient-to-b from-indigo-100 to-blue-50">
            <h1 class="text-2xl font-bold text-indigo-700 mb-8">@yield('title')</h1>
            @yield('content')
        </div>
    </div>

</body>
</html>
