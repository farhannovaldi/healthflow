@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the modal -->
        <button id="openModalButton" class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600">
            Tambah Jadwal Dokter
        </button>

        <!-- FullCalendar Container -->
        <div id="calendar"></div>
    </div>

    <!-- Modal -->
    <div id="addJadwalDokterModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-2xl font-bold">Tambah Jadwal Dokter</h5>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <form id="addJadwalDokterForm">
                @csrf
                <div class="mb-4">
                    <label for="dokter_id" class="block text-gray-700">Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-select w-full">
                        @foreach ($dokter as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="hari" class="block text-gray-700">Hari</label>
                    <input type="text" id="hari" name="hari" class="form-input w-full rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="jam_mulai" class="block text-gray-700">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" class="form-input w-full rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="jam_selesai" class="block text-gray-700">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" class="form-input w-full rounded-md p-2"
                        required>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize FullCalendar
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridWeek',
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '{{ route('jadwaldokter.getJadwal') }}',
                        method: 'GET',
                        success: function(response) {
                            successCallback(response);
                        },
                        error: function() {
                            failureCallback();
                        }
                    });
                },
                eventDidMount: function(info) {
                    // Tooltip untuk menampilkan detail dokter
                    $(info.el).tooltip({
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridWeek,dayGridMonth'
                }
            });

            calendar.render();

            // Modal
            const openModalButton = $('#openModalButton');
            const closeModalButton = $('#closeModalButton');
            const modal = $('#addJadwalDokterModal');

            openModalButton.on('click', () => modal.removeClass('hidden'));
            closeModalButton.on('click', () => modal.addClass('hidden'));

            // Form Submission
            $('#addJadwalDokterForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('jadwaldokter.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        modal.addClass('hidden');
                        calendar.refetchEvents(); // Refresh kalender
                        $('#addJadwalDokterForm')[0].reset();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseJSON);
                    }
                });
            });
        });
    </script>
@endpush
