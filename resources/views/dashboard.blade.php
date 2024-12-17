@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Dashboard Overview -->
        <div class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Dashboard Medis Anda</h3>
            <p class="text-gray-600">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Di sini Anda dapat melihat aktivitas medis terbaru dan mengelola data pasien, dokter, resep obat, dan jadwal dokter.</p>
        </div>

        <!-- Recent Activity -->
        <div class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Aktivitas Terbaru</h3>
            <ul class="space-y-2 text-gray-600">
                <li>Pasien baru terdaftar: <strong>John Doe</strong></li>
                <li>Jadwal dokter terbaru: <strong>Dr. Smith</strong> - <span class="text-green-500">Terjadwal</span></li>
                <li>Resep obat untuk pasien <strong>Jane Smith</strong> diterbitkan</li>
            </ul>
        </div>
    </div>

    <!-- Stat Chart Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Statistik Medis</h3>
            <canvas id="healthStatsChart"></canvas>
        </div>

        <!-- Timeline Section -->
        <div class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Timeline Aktivitas Medis</h3>
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="h-2 w-2 rounded-full bg-green-500 mr-4"></div>
                    <div>Pasien baru <strong>John Doe</strong> mendaftar</div>
                </div>
                <div class="flex items-center">
                    <div class="h-2 w-2 rounded-full bg-blue-500 mr-4"></div>
                    <div>Jadwal dokter dengan <strong>Dr. Smith</strong> terjadwal pada <strong>10 Januari 2024</strong></div>
                </div>
                <div class="flex items-center">
                    <div class="h-2 w-2 rounded-full bg-yellow-500 mr-4"></div>
                    <div>Resep obat untuk <strong>Jane Smith</strong> diterbitkan pada <strong>12 Desember 2024</strong></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Notifications Section -->
    <div class="mt-6 bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Notifikasi Terkini</h3>
        <ul class="space-y-2 text-gray-600">
            <li class="flex justify-between">
                <span>Pesan baru dari <strong>Dr. Smith</strong></span>
                <span class="text-gray-400 text-sm">2 menit yang lalu</span>
            </li>
            <li class="flex justify-between">
                <span><strong>Pendaftaran pasien</strong> berhasil</span>
                <span class="text-gray-400 text-sm">5 menit yang lalu</span>
            </li>
            <li class="flex justify-between">
                <span>Permintaan baru untuk <strong>Laboratorium</strong> diterima</span>
                <span class="text-gray-400 text-sm">15 menit yang lalu</span>
            </li>
        </ul>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Inisialisasi Chart.js untuk grafik statistik medis
        const ctx = document.getElementById('healthStatsChart').getContext('2d');
        const healthStatsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Data bulan
                datasets: [{
                    label: 'Jumlah Pasien Terdaftar',
                    data: [10, 20, 30, 40, 50], // Data pasien terdaftar, ganti dengan data dinamis
                    borderColor: '#4C51BF',
                    fill: false,
                    tension: 0.1
                }, {
                    label: 'Jumlah Resep Obat',
                    data: [5, 10, 15, 20, 25], // Data resep obat, ganti dengan data dinamis
                    borderColor: '#FF6347',
                    fill: false,
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection
