<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HealthFlow</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2771/2771400.png" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
        }

        .sidebar a {
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            transform: scale(1.05);
            background-color: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            background: #f9fafc;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .sidebar h2 a {
            color: #fff;
            transition: color 0.3s ease;
        }

        .sidebar h2 a:hover {
            color: #ffd700;
        }

        button {
            transition: all 0.3s ease;
        }

        button:hover {
            background: #e63946;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 to-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-1/4 sidebar p-6 text-white flex flex-col justify-between shadow-lg">
        <div>
            <h2 class="text-3xl font-bold text-center mb-8">
                <a href="{{ route('dashboard') }}">
                    HealthFlow
                </a>
            </h2>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('pasien.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-white hover:text-indigo-800 transition">
                        <i class="fas fa-users mr-3"></i> Data Pasien
                    </a>
                </li>
                <li>
                    <a href="{{ route('dokter.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-white hover:text-indigo-800 transition">
                        <i class="fas fa-user-md mr-3"></i> Data Dokter
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwaldokter.getAllJadwal') }}" class="flex items-center py-2 px-4 rounded hover:bg-white hover:text-indigo-800 transition">
                        <i class="fas fa-calendar-alt mr-3"></i> Jadwal Dokter
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwaldokter.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-white hover:text-indigo-800 transition">
                        <i class="fas fa-calendar-alt mr-3"></i> Kelola Jadwal Dokter
                    </a>
                </li>
                <li>
                    <a href="{{ route('obat.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-white hover:text-indigo-800 transition">
                        <i class="fas fa-pills mr-3"></i> Data Obat
                    </a>
                </li>
                <li>
                    <a href="{{ route('pasienvisit.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-white hover:text-indigo-800 transition">
                        <i class="fas fa-history mr-3"></i> History Pasien
                    </a>
                </li>
            </ul>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center justify-center w-full py-2 px-4 rounded bg-red-500 hover:bg-red-600 text-white">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="w-3/4 p-8 main-content">
        <div class="card">
            <h1 class="text-3xl font-bold text-indigo-700 mb-8 border-b-2 border-indigo-300 pb-4">@yield('title') - HealthFlow</h1>
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
