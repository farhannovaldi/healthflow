@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Data Dokter</h2>
        <!-- Tampilkan data dokter di sini -->
        @foreach($dokter as $data)
            <p>{{ $data->nama }} - {{ $data->spesialis }}</p>
        @endforeach
    </div>
@endsection
