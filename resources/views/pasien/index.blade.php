@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the modal -->
        <button id="openModalButton" class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600 transition-all">
            Tambah Pasien
        </button>

        <!-- Data Table -->
        <table id="pasienTable" class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Tanggal Lahir</th>
                    <th class="border px-4 py-2">Alamat</th>
                    <th class="border px-4 py-2">Telepon</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <div id="addPasienModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative">
            <div class="flex justify-between items-center mb-4">
                <h5 id="modalTitle" class="text-2xl font-bold">Tambah Pasien</h5>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>
            <form id="pasienForm">
                @csrf
                <input type="hidden" id="pasienId" name="id">
                <input type="hidden" name="_method" id="_method" value="POST">

                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama</label>
                    <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="nama"
                        name="nama" required>
                </div>
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
                    <input type="date" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="tanggal_lahir"
                        name="tanggal_lahir" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700">Alamat</label>
                    <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="alamat"
                        name="alamat" required>
                </div>
                <div class="mb-4">
                    <label for="telepon" class="block text-gray-700">Telepon</label>
                    <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="telepon"
                        name="telepon" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-all">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const modal = $('#addPasienModal');
            const openModalButton = $('#openModalButton');
            const closeModalButton = $('#closeModalButton');
            const pasienForm = $('#pasienForm');
            const pasienIdInput = $('#pasienId');
            const methodInput = $('#_method');
            const modalTitle = $('#modalTitle');

            // Initialize DataTable
            const table = $('#pasienTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pasien.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        render: function(data) {
                            if (data) {
                                const date = new Date(data);
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const year = date.getFullYear();
                                return `${day}-${month}-${year}`;
                            }
                            return '';
                        }
                    },

                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: (data) => `
                            <button class="editButton bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                                data-id="${data.id}" data-nama="${data.nama}" data-tanggal_lahir="${data.tanggal_lahir}"data-alamat="${data.alamat}"
                                data-telepon="${data.telepon}">Edit</button>
                            <button class="deleteButton bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                data-id="${data.id}">Hapus</button>
                        `
                    }
                ]
            });

            // Open Modal
            openModalButton.on('click', () => {
                pasienForm[0].reset();
                pasienIdInput.val('');
                methodInput.val('POST');
                modalTitle.text('Tambah Pasien');
                modal.removeClass('hidden');
            });

            // Close Modal
            closeModalButton.on('click', () => modal.addClass('hidden'));
            $(window).on('click', (e) => {
                if (e.target === modal[0]) modal.addClass('hidden');
            });

            // Submit Form
            pasienForm.on('submit', function(e) {
                e.preventDefault();
                const id = pasienIdInput.val();
                const url = id ? `/pasien/${id}` : "{{ route('pasien.store') }}";

                $.ajax({
                    url: url,
                    method: methodInput.val(),
                    data: pasienForm.serialize(),
                    success: (response) => {
                        modal.addClass('hidden');
                        table.ajax.reload();
                        Swal.fire('Berhasil!', response.message, 'success');
                    },
                    error: (xhr) => {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
                    }
                });
            });

            // Edit Button
            $('#pasienTable').on('click', '.editButton', function() {
                const data = $(this).data();
                pasienIdInput.val(data.id);
                $('#nama').val(data.nama);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#alamat').val(data.alamat);
                $('#telepon').val(data.telepon);
                methodInput.val('PUT');
                modalTitle.text('Edit Pasien');
                modal.removeClass('hidden');
            });

            // Delete Button
            $('#pasienTable').on('click', '.deleteButton', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin Hapus Data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/pasien/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: () => {
                                table.ajax.reload();
                                Swal.fire('Deleted!', 'Data berhasil dihapus.',
                                    'success');
                            },
                            error: () => Swal.fire('Error!', 'Gagal menghapus data.',
                                'error')
                        });
                    }
                });
            });
        });
    </script>
@endpush
