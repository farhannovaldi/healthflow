@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- FullCalendar Container -->
        <div id="calendar"></div>
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
                        data: {
                            start: fetchInfo.startStr, // Rentang waktu awal
                            end: fetchInfo.endStr // Rentang waktu akhir
                        },
                        success: function(response) {
                            successCallback(response);
                        },
                        error: function() {
                            console.error('Gagal mengambil data jadwal.');
                            failureCallback();
                        }
                    });
                },
                eventDidMount: function(info) {
                    // Membuat konten tooltip dengan informasi hanya jam
                    const startTime = info.event.start.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const endTime = info.event.end.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const tooltipContent = `
                        <div class="tooltip-inner">
                            <div><strong>Nama:</strong> ${info.event.extendedProps.description}</div>
                            <div><strong>Jadwal:</strong> ${startTime} - ${endTime}</div>
                        </div>
                    `;

                    // Tooltip dengan format konten baru dan menggunakan Bootstrap
                    $(info.el).tooltip({
                        title: tooltipContent,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true // Mengizinkan HTML dalam tooltip
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
