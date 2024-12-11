<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HealthFlow</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-gradient-to-b from-indigo-100 to-blue-200 min-h-screen font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gradient-to-b from-blue-900 to-indigo-700 p-6 text-white flex flex-col justify-between">
            <div>
                <h2 class="text-3xl font-bold text-center mb-8">HealthFlow</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('pasien.index') }}"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-users mr-3"></i> Data Pasien
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-user-md mr-3"></i> Data Dokter
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-calendar-alt mr-3"></i> Jadwal Dokter
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-pills mr-3"></i> Data Obat
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-history mr-3"></i> History Pasien
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('logout') }}"
                class="flex items-center justify-center py-2 px-4 rounded bg-red-500 hover:bg-red-600 transition-colors">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
        <!-- Main Content -->
        <div class="w-3/4 p-8 bg-gradient-to-b from-indigo-100 to-blue-50">
            <h1 class="text-2xl font-bold text-indigo-700 mb-8">@yield('title') - HealthFlow</h1>
            @yield('content')
        </div>
    </div>

    @stack('scripts')

</body>

</html>
