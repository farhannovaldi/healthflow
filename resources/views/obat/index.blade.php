@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the modal -->
        <button id="openModalButton"
            class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600 transition-all">Tambah Obat</button>

        <!-- Toolbar for the table (Optional) -->
        <div class="mb-4">
            <!-- Example of additional controls like search, filters, etc. -->
            <!-- Add any toolbar controls here -->
        </div>

        <!-- Data Table -->
        <table id="obatTable" class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama Obat</th>
                    <th class="border px-4 py-2">Jenis</th>
                    <th class="border px-4 py-2">Stok</th>
                    <th class="border px-4 py-2">Dosis</th>
                    <th class="border px-4 py-2">Harga</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <!-- Modal for Adding/Editing Obat -->
    <div id="obatModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h5 id="modalTitle" class="text-2xl font-bold">Tambah Obat</h5>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="obatForm">
                    @csrf
                    <input type="hidden" id="obatId" name="id">
                    <input type="hidden" id="_method" name="_method" value="POST"> <!-- Untuk PUT Method -->

                    <div class="mb-4">
                        <label for="nama_obat" class="block text-gray-700">Nama Obat</label>
                        <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="nama_obat"
                            name="nama_obat" required>
                    </div>
                    <div class="mb-4">
                        <label for="jenis" class="block text-gray-700">Jenis</label>
                        <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="jenis"
                            name="jenis" required>
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-gray-700">Stok</label>
                        <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="stok"
                            name="stok" required>
                    </div>
                    <div class="mb-4">
                        <label for="dosis" class="block text-gray-700">Dosis</label>
                        <input type="text" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="dosis"
                            name="dosis" required>
                    </div>
                    <div class="mb-4">
                        <label for="harga" class="block text-gray-700">Harga</label>
                        <input type="int" class="form-input mt-1 block w-full border-2 rounded-md p-2" id="harga"
                            name="harga" required>
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
        const modal = document.getElementById('obatModal');
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modalTitle = document.getElementById('modalTitle');
        const obatForm = document.getElementById('obatForm');
        const obatIdInput = document.getElementById('obatId');
        const methodInput = document.getElementById('_method');

        // Open Modal for Adding
        openModalButton.addEventListener('click', () => {
            obatForm.reset();
            obatIdInput.value = '';
            methodInput.value = 'POST';
            modalTitle.textContent = 'Tambah Obat';
            modal.classList.remove('hidden');
        });

        // Close Modal
        closeModalButton.addEventListener('click', () => modal.classList.add('hidden'));
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });


        $(document).ready(function() {
            // Initialize DataTable with Tailwind styling
            const table = $('#obatTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('obat.index') }}",
                columns: [{
                        data: 'nama_obat',
                        name: 'nama_obat'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'dosis',
                        name: 'dosis'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: (data) => `
                            <button class="editButton bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                                data-id="${data.id}" data-nama_obat="${data.nama_obat}" data-jenis="${data.jenis}"
                                data-stok="${data.stok}" data-dosis="${data.dosis}"data-harga="${data.harga}">Edit</button>
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
            $('#obatTable').on('click', '.editButton', function() {
                const obat = $(this).data();
                obatIdInput.value = obat.id;
                methodInput.value = 'PUT';
                $('#nama_obat').val(obat.nama_obat);
                $('#jenis').val(obat.jenis);
                $('#stok').val(obat.stok);
                $('#dosis').val(obat.dosis);
                $('#harga').val(parseInt(obat.harga)); 


                modalTitle.textContent = 'Edit Obat';
                modal.classList.remove('hidden');
            });
            // Handle Form Submission for Add/Edit
            $('#obatForm').on('submit', function(e) {
                e.preventDefault();

                const id = obatIdInput.value;
                const url = id ? `/obat/${id}` : "{{ route('obat.store') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: (response) => {
                        modal.classList.add('hidden');
                        table.ajax.reload();
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message || 'Data berhasil disimpan!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: (xhr) => {
                        const errors = xhr.responseJSON?.errors;
                        let message = 'Terjadi kesalahan:\n';
                        if (errors) {
                            message += Object.values(errors).map(err => `- ${err}`).join('\n');
                        }
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
            $('#obatTable').on('click', '.deleteButton', function() {
                const id = $(this).data('id');
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
                            url: `/obat/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: (response) => {
                                table.ajax.reload();
                                Swal.fire('Deleted!', response.message ||
                                    'Data berhasil dihapus.', 'success');
                            },
                            error: () => {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
