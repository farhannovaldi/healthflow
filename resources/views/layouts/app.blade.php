<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HealthFlow</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2771/2771400.png" type="image/png">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-gradient-to-b from-indigo-100 to-blue-200 min-h-screen font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div
            class="w-1/4 bg-gradient-to-b from-blue-900 to-indigo-700 p-6 text-white flex flex-col justify-between shadow-lg">
            <div>
                <h2 class="text-3xl font-bold text-center mb-8">
                    <a href="{{ route('dashboard') }}" class="hover:underline text-white-600">
                        HealthFlow
                    </a>
                </h2>

                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('pasien.index') }}"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors {{ request()->is('pasien*') ? 'bg-indigo-600' : '' }}">
                            <i class="fas fa-users mr-3"></i> Data Pasien
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dokter.index') }}"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors {{ request()->is('dokter*') ? 'bg-indigo-600' : '' }}">
                            <i class="fas fa-user-md mr-3"></i> Data Dokter
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jadwaldokter.index') }}"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors {{ request()->is('jadwaldokter*') ? 'bg-indigo-600' : '' }}">
                            <i class="fas fa-calendar-alt mr-3"></i> Jadwal Dokter
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('obat.index') }}"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors {{ request()->is('obat*') ? 'bg-indigo-600' : '' }}">
                            <i class="fas fa-pills mr-3"></i> Data Obat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pasienvisit.index') }}"
                            class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors {{ request()->is('pasienvisit*') ? 'bg-indigo-600' : '' }}">
                            <i class="fas fa-history mr-3"></i> History Pasien
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('logout') }}"
                class="flex items-center justify-center py-2 px-4 rounded bg-red-500 hover:bg-red-600 transition-colors mt-4">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
        <!-- Main Content -->
        <div class="w-3/4 p-8 bg-gradient-to-b from-indigo-100 to-blue-50 shadow-lg rounded-lg">
            <h1 class="text-3xl font-bold text-indigo-700 mb-8 border-b-2 border-indigo-300 pb-4">@yield('title') -
                HealthFlow</h1>
            @yield('content')
        </div>
    </div>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>
