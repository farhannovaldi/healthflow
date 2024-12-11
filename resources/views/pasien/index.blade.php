@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the modal -->
        <button id="openModalButton"
            class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600 transition-all">Tambah Pasien</button>

        <!-- Toolbar for the table (Optional) -->
        <div class="mb-4">
            <!-- Example of additional controls like search, filters, etc. -->
            <!-- Add any toolbar controls here -->
        </div>

        <!-- Data Table -->
        <table id="pasienTable" class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
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
            <!-- Modal Header with Close Button -->
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-2xl font-bold">Tambah Pasien</h5>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="addPasienForm">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700">Nama</label>
                        <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="nama"
                            name="nama" required>
                    </div>
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
                        <input type="date" class="form-input mt-1 block w-full border-2 rounded-md p-2"
                            id="tanggal_lahir" name="tanggal_lahir" required>
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
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-all">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Get modal and buttons
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modal = document.getElementById('addPasienModal');

        // Open modal
        openModalButton.addEventListener('click', function() {
            modal.classList.remove('hidden'); // Show modal
        });

        // Close modal
        closeModalButton.addEventListener('click', function() {
            modal.classList.add('hidden'); // Hide modal
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden'); // Hide modal
            }
        });

        $(document).ready(function() {
            // Initialize DataTable with Tailwind styling
            var table = $('#pasienTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pasien.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
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
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            const editUrl = `/pasien/${row.id}/edit`;
                            const deleteUrl = `/pasien/${row.id}`;
                            return `
                            <a href="${editUrl}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                            <form action="${deleteUrl}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                            </form>
                        `;
                        }
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });

            // Handle form submission via AJAX
            $('#addPasienForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('pasien.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Hide modal
                        $('#addPasienModal').modal('hide');

                        // Reset form
                        $('#addPasienForm')[0].reset();

                        // Refresh the DataTable
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan, silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endpush
