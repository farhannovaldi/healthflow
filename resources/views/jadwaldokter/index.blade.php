@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the modal -->
        <button id="openModalButton" class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600 transition-all">
            Tambah Jadwal Dokter
        </button>

        <!-- Calendar Container -->
        <div id="calendar"></div>
    </div>

<!-- Modal -->
<div id="addJadwalDokterModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative">
        <!-- Modal Header with Close Button -->
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-2xl font-bold">Tambah Jadwal Dokter</h5>
            <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <form id="addJadwalDokterForm">
                @csrf
                <div class="mb-4">
                    <label for="dokter_id" class="block text-gray-700">Dokter</label>
                    <select name="dokter_id" id="dokter_id">
                        @foreach ($dokter as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>

                    <span id="dokter_id_error" class="text-red-500 text-sm hidden">Harap pilih dokter.</span>
                </div>

                <div class="mb-4">
                    <label for="hari" class="block text-gray-700">Hari</label>
                    <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="hari"
                        name="hari" required>
                    <span id="hari_error" class="text-red-500 text-sm hidden">Harap masukkan hari.</span>
                </div>

                <div class="mb-4">
                    <label for="jam_mulai" class="block text-gray-700">Jam Mulai</label>
                    <input type="time" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="jam_mulai"
                        name="jam_mulai" required>
                    <span id="jam_mulai_error" class="text-red-500 text-sm hidden">Harap masukkan jam mulai.</span>
                </div>

                <div class="mb-4">
                    <label for="jam_selesai" class="block text-gray-700">Jam Selesai</label>
                    <input type="time" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="jam_selesai"
                        name="jam_selesai" required>
                    <span id="jam_selesai_error" class="text-red-500 text-sm hidden">Harap masukkan jam selesai.</span>
                </div>

                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-all">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize FullCalendar
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridWeek', // Menampilkan tampilan minggu
                events: function(info, successCallback, failureCallback) {
                    $.ajax({
                        url: '{{ route('jadwaldokter.getJadwal') }}',
                        method: 'GET',
                        success: function(response) {
                            var events = response.map(function(jadwal) {
                                return {
                                    title: jadwal.dokter.nama + ' - ' + jadwal.hari,
                                    start: jadwal.jam_mulai,
                                    end: jadwal.jam_selesai,
                                    description: 'Dokter: ' + jadwal.dokter.nama +
                                        '\n' + 'Hari: ' + jadwal.hari
                                };
                            });
                            successCallback(events);
                        },
                        error: function() {
                            failureCallback();
                        }
                    });
                },
                locale: 'id', // Menggunakan bahasa Indonesia
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridWeek,dayGridMonth'
                }
            });

            // Render kalender
            calendar.render();

            // Modal
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');
            const modal = document.getElementById('addJadwalDokterModal');

            openModalButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            // Handle form submission via AJAX
            $('#addJadwalDokterForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('jadwaldokter.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addJadwalDokterModal').addClass('hidden');
                        $('#addJadwalDokterForm')[0].reset();

                        // Menambahkan event baru ke kalender
                        calendar.addEvent({
                            title: response.dokter.nama + ' - ' + response.hari,
                            start: response.jam_mulai,
                            end: response.jam_selesai,
                            description: 'Dokter: ' + response.dokter.nama + '\n' +
                                'Hari: ' + response.hari
                        });

                        // Memperbarui kalender
                        calendar
                    .refetchEvents(); // Ini opsional, jika Anda ingin me-refresh semua event
                    },

                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            if (errors.dokter_id) {
                                $('#dokter_id_error').text(errors.dokter_id[0]).removeClass(
                                    'hidden');
                            }
                            if (errors.hari) {
                                $('#hari_error').text(errors.hari[0]).removeClass('hidden');
                            }
                            if (errors.jam_mulai) {
                                $('#jam_mulai_error').text(errors.jam_mulai[0]).removeClass(
                                    'hidden');
                            }
                            if (errors.jam_selesai) {
                                $('#jam_selesai_error').text(errors.jam_selesai[0]).removeClass(
                                    'hidden');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
