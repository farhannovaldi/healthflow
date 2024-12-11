@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
            class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Dashboard Anda</h3>
            <p class="text-gray-600">Selamat datang di dashboard! Di sini Anda dapat melihat aktivitas dan mengelola akun
                Anda.</p>
        </div>
        <div
            class="bg-gradient-to-b from-white to-indigo-50 p-6 rounded-lg shadow hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Aktivitas Terbaru</h3>
            <p class="text-gray-600">Lihat aktivitas terbaru yang telah Anda lakukan.</p>
        </div>
    </div>
@endsection
