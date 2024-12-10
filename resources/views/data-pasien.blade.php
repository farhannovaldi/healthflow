@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Data Pasien</h2>
        <!-- Tampilkan data pasien di sini -->
        @foreach($pasien as $data)
            <p>{{ $data->nama }} - {{ $data->umur }} tahun</p>
        @endforeach
    </div>
@endsection
