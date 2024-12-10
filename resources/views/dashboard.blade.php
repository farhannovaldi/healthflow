<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-100 to-blue-200 min-h-screen font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gradient-to-b from-blue-900 to-indigo-700 p-6 text-white flex flex-col justify-between">
            <div>
                <h2 class="text-3xl font-bold text-center mb-8">HealthFlow</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="/data-pasien" class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-users mr-3"></i> Data Pasien
                        </a>
                    </li>
                    <li>
                        <a href="/data-dokter" class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-user-md mr-3"></i> Data Dokter
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-calendar-alt mr-3"></i> Jadwal Dokter
                        </a>
                    </li>
                    <li>
                        <a href="/data-obat" class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-pills mr-3"></i> Data Obat
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-history mr-3"></i> History Pasien
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('logout') }}" class="flex items-center justify-center py-2 px-4 rounded bg-red-500 hover:bg-red-600 transition-colors">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-8 bg-gradient-to-br from-indigo-50 via-indigo-100 to-blue-50">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-indigo-800">Hi, {{ Auth::user()->name }}!</h1>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                    <h3 class="text-xl font-semibold text-indigo-800 mb-2">Dashboard Anda</h3>
                    <p class="text-gray-600">Selamat datang di dashboard! Di sini Anda dapat melihat aktivitas dan mengelola akun Anda.</p>
                </div>
                <div class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                    <h3 class="text-xl font-semibold text-indigo-800 mb-2">Aktivitas Terbaru</h3>
                    <p class="text-gray-600">Lihat aktivitas terbaru yang telah Anda lakukan.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
