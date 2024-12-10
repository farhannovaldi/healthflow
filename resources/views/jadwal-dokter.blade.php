@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Jadwal Dokter</h2>
        <!-- Tampilkan jadwal dokter di sini -->
        @foreach($jadwal as $data)
            <p>{{ $data->dokter }} - {{ $data->hari }} ({{ $data->jam_mulai }} - {{ $data->jam_selesai }})</p>
        @endforeach
    </div>
@endsection
