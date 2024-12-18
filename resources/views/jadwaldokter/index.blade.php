@extends('layouts.app')

@section('title', 'Data Jadwal Dokter')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the Add Modal -->
        <button id="openModalButton"
            class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600 transition-all">Tambah Jadwal</button>

        <!-- Data Table -->
        <table id="dokterTable" class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Spesialis</th>
                    <th class="border px-4 py-2">Hari</th>
                    <th class="border px-4 py-2">Jam Mulai</th>
                    <th class="border px-4 py-2">Jam Selesai</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal for Adding/Editing Dokter -->
    <div id="dokterModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h5 id="modalTitle" class="text-2xl font-bold">Tambah Dokter</h5>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="dokterForm">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="_method" name="_method" value="POST"> <!-- Untuk PUT Method -->

                    <div class="mb-4">
                        <label for="dokter_id" class="block text-gray-700">Nama Dokter</label>
                        <select id="dokter_id" name="dokter_id"
                            class="form-select mt-1 block w-full border-2 rounded-md p-2" required>
                            <option value="" disabled selected>Pilih Dokter</option>
                            @foreach ($dokter as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }} - {{ $data->spesialis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="hari" class="block text-gray-700">Hari</label>
                        <input type="text" id="hari" name="hari"
                            class="form-input mt-1 block w-full border-2 rounded-md p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="jam_mulai" class="block text-gray-700">Jam Mulai</label>
                        <input type="time" id="jam_mulai" name="jam_mulai"
                            class="form-input mt-1 block w-full border-2 rounded-md p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="jam_selesai" class="block text-gray-700">Jam Selesai</label>
                        <input type="time" id="jam_selesai" name="jam_selesai"
                            class="form-input mt-1 block w-full border-2 rounded-md p-2" required>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-all">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const modal = document.getElementById('dokterModal');
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modalTitle = document.getElementById('modalTitle');
        const dokterForm = document.getElementById('dokterForm');
        const dokterIdInput = document.getElementById('id');
        const methodInput = document.getElementById('_method');

        // Open Modal for Adding
        openModalButton.addEventListener('click', () => {
            dokterForm.reset();
            dokterIdInput.value = '';
            methodInput.value = 'POST';
            modalTitle.textContent = 'Tambah Dokter';
            modal.classList.remove('hidden');
        });

        // Close Modal
        closeModalButton.addEventListener('click', () => modal.classList.add('hidden'));
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });

        // Initialize DataTable
        $(document).ready(function() {
            const table = $('#dokterTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jadwaldokter.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'spesialis',
                        name: 'spesialis'
                    },
                    {
                        data: 'hari',
                        name: 'hari'
                    },
                    {
                        data: 'jam_mulai',
                        name: 'jam_mulai'
                    },
                    {
                        data: 'jam_selesai',
                        name: 'jam_selesai'
                    },
                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: (data) => `
                            <button class="editButton bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                                data-id="${data.id}" data-nama="${data.nama}"
                                data-hari="${data.hari}" data-jam_mulai="${data.jam_mulai}"data-jam_selesai="${data.jam_selesai}">Edit</button>
                            <button class="deleteButton bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                data-id="${data.id}">Hapus</button>
                        `
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });

            // Handle Edit Button Click
            $('#dokterTable').on('click', '.editButton', function() {
                const dokter = $(this).data();
                dokterIdInput.value = dokter.id;
                methodInput.value = 'PUT';
                $('#nama').val(dokter.nama);
                $('#hari').val(dokter.hari);
                $('#jam_mulai').val(dokter.jam_mulai);
                $('#jam_selesai').val(dokter.jam_selesai);

                modalTitle.textContent = 'Edit Dokter';
                modal.classList.remove('hidden');
            });

            // Handle Form Submission for Add/Edit
            $('#dokterForm').on('submit', function(e) {
                e.preventDefault();

                const id = dokterIdInput.value;
                const url = id ? `/jadwaldokter/${id}` : "{{ route('jadwaldokter.store') }}";
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: (response) => {
                        modal.classList.add('hidden');
                        table.ajax.reload();
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: (xhr) => {
                        const errors = xhr.responseJSON?.errors || {};
                        let message = 'Terjadi kesalahan:\n';
                        message += Object.values(errors).map(err => `- ${err}`).join('\n');
                        Swal.fire({
                            title: 'Gagal!',
                            text: message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Handle Delete Button Click
            // Handle Delete Button Click
            $('#dokterTable').on('click', '.deleteButton', function() {
                const id = $(this).data('id'); // Pastikan ID ini berasal dari data tabel
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/jadwaldokter/${id}`, // Endpoint dengan ID jadwal_dokter
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}" // CSRF Token Laravel
                            },
                            success: (response) => {
                                table.ajax.reload();
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message ||
                                        'Data berhasil dihapus!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            },
                            error: (xhr) => {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: xhr.responseJSON?.message ||
                                        'Terjadi kesalahan saat menghapus data.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
