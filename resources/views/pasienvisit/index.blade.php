@extends('layouts.app')

@section('title', 'Data Kunjungan Pasien')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Button to trigger the modal -->
        <button id="openModalButton" class="bg-green-500 text-white px-6 py-3 rounded mb-6 hover:bg-green-600 transition-all">
            Tambah Kunjungan
        </button>

        <!-- Data Table -->
        <table id="pasienTable" class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama Pasien</th>
                    <th class="border px-4 py-2">Nama Dokter</th>
                    <th class="border px-4 py-2">Tanggal Kunjungan</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal for Adding/Editing Kunjungan Pasien -->
    <div id="addPasienModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h5 id="modalTitle" class="text-2xl font-bold">Tambah Kunjungan Pasien</h5>
                <button id="closeModalButton" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="pasienForm">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="_method" name="_method" value="POST">

                    <div class="mb-4">
                        <label for="pasien_id" class="block text-gray-700">Nama Pasien</label>
                        <select id="pasien_id" name="pasien_id"
                            class="form-select mt-1 block w-full border-2 rounded-md p-2" required>
                            <option value="" disabled selected>Pilih Pasien</option>
                            @foreach ($pasien as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="dokter_id" class="block text-gray-700">Nama Dokter</label>
                        <select id="dokter_id" name="dokter_id"
                            class="form-select mt-1 block w-full border-2 rounded-md p-2" required>
                            <option value="" disabled selected>Pilih Dokter</option>
                            @foreach ($dokter as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_kunjungan" class="block text-gray-700">Tanggal Kunjungan</label>
                        <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan"
                            class="form-input mt-1 block w-full border-2 rounded-md p-2" required>
                    </div>

                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-all">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for Viewing Kunjungan Pasien Detail -->
    <div id="detailPasienModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div
            class="bg-white rounded-lg shadow-xl w-full max-w-lg p-8 relative transform transition-transform duration-300 scale-95 hover:scale-100">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 id="detailModalTitle" class="text-2xl font-semibold text-gray-900">Detail Kunjungan Pasien</h5>
                <button id="closeDetailModalButton" class="text-gray-600 hover:text-gray-800 text-4xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body space-y-6 text-gray-800">
                <div class="flex justify-between text-lg">
                    <p class="font-semibold">Nama Pasien:</p>
                    <span id="detailPasienNama" class="font-normal">-</span>
                </div>
                <div class="flex justify-between text-lg">
                    <p class="font-semibold">Nama Dokter:</p>
                    <span id="detailDokterNama" class="font-normal">-</span>
                </div>
                <div class="flex justify-between text-lg">
                    <p class="font-semibold">Tanggal Kunjungan:</p>
                    <span id="detailTanggalKunjungan" class="font-normal">-</span>
                </div>
                <div class="flex justify-between text-lg">
                    <p class="font-semibold">Keluhan:</p>
                    <span id="detailKeluhan" class="font-normal">-</span>
                </div>
                <div class="flex justify-between text-lg">
                    <p class="font-semibold">Diagnosis:</p>
                    <span id="detailDiagnosis" class="font-normal">-</span>
                </div>
                <div class="flex justify-between text-lg">
                    <p class="font-semibold">Tindakan:</p>
                    <span id="detailTindakan" class="font-normal">-</span>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="mt-4 flex justify-end">
                <button id="editDetailButton"
                    class="bg-yellow-500 text-white px-6 py-3 rounded hover:bg-yellow-600 transition-all">Edit
                    Keterangan</button>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Kunjungan Pasien Detail -->
    <div id="editDetailPasienModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-8 relative">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 id="editModalTitle" class="text-2xl font-semibold text-gray-900">Edit Detail Kunjungan Pasien</h5>
                <button id="closeEditDetailModalButton" class="text-gray-600 hover:text-gray-800 text-4xl">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body space-y-6 text-gray-800">
                <form id="editPasienForm">
                    @csrf
                    <input type="hidden" id="edit_pasien_id" name="pasien_id">
                    <input type="hidden" id="edit_kunjungan_id" name="kunjungan_id">

                    <div class="mb-4">
                        <label for="edit_keluhan" class="block text-gray-700">Keluhan</label>
                        <textarea id="edit_keluhan" name="keluhan" class="form-textarea mt-1 block w-full border-2 rounded-md p-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="edit_diagnosis" class="block text-gray-700">Diagnosis</label>
                        <textarea id="edit_diagnosis" name="diagnosis" class="form-textarea mt-1 block w-full border-2 rounded-md p-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="edit_tindakan" class="block text-gray-700">Tindakan</label>
                        <textarea id="edit_tindakan" name="tindakan" class="form-textarea mt-1 block w-full border-2 rounded-md p-2"></textarea>
                    </div>

                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-all">Simpan
                        Perubahan</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const modal = document.getElementById('addPasienModal');
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modalTitle = document.getElementById('modalTitle');
        const pasienForm = document.getElementById('pasienForm');
        const pasienIdInput = document.getElementById('id');
        const methodInput = document.getElementById('_method');

        // Open Modal for Adding
        openModalButton.addEventListener('click', () => {
            pasienForm.reset();
            pasienIdInput.value = '';
            methodInput.value = 'POST';
            modalTitle.textContent = 'Tambah Kunjungan Pasien';
            $('#pasien_id').prop('disabled', false); // Remove disabled attribute
            modal.classList.remove('hidden');
        });

        // Close Modal
        closeModalButton.addEventListener('click', () => modal.classList.add('hidden'));
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });

        // Initialize DataTable
        $(document).ready(function() {
            const table = $('#pasienTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pasienvisit.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'pasien.nama',
                        name: 'pasien.nama'
                    },
                    {
                        data: 'dokter.nama',
                        name: 'dokter.nama'
                    },
                    {
                        data: 'tanggal_kunjungan',
                        name: 'tanggal_kunjungan'
                    },
                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: (data) => `
        <button class="editButton bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
            data-id="${data.id}" data-pasien="${data.pasien_id}" data-dokter="${data.dokter_id}" data-tanggal="${data.tanggal_kunjungan}">Edit</button>
        <button class="deleteButton bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
            data-id="${data.id}">Hapus</button>
        <button class="detailButton bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            data-id="${data.id}">Detail</button>
    `
                    }

                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });

            // Handle Edit Button Click
            $('#pasienTable').on('click', '.editButton', function() {
                const kunjungan = $(this).data();
                pasienIdInput.value = kunjungan.id;
                methodInput.value = 'PUT';
                $('#pasien_id').val(kunjungan.pasien);
                $('#dokter_id').val(kunjungan.dokter);
                $('#tanggal_kunjungan').val(kunjungan.tanggal);

                $('#pasien_id').prop('disabled', true); // Add disabled attribute
                modalTitle.textContent = 'Edit Kunjungan Pasien';
                modal.classList.remove('hidden');
            });

            // Handle Form Submission
            $('#pasienForm').on('submit', function(e) {
                e.preventDefault();
                const id = pasienIdInput.value;
                const url = id ? `/pasienvisit/${id}` : "{{ route('pasienvisit.store') }}";
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: (response) => {
                        modal.classList.add('hidden');
                        table.ajax.reload();
                        Swal.fire('Berhasil!', response.message, 'success');
                    },
                    error: (xhr) => {
                        Swal.fire('Gagal!', xhr.responseJSON?.message || 'Terjadi kesalahan.',
                            'error');
                    }
                });
            });

            // Handle Detail Button Click
            $('#pasienTable').on('click', '.detailButton', function() {
                const id = $(this).data('id');

                // Fetch data for the selected kunjungan using AJAX
                $.ajax({
                    url: `/pasienvisit/${id}`, // Pastikan route ini mengarah ke route yang tepat
                    method: 'GET',
                    success: (response) => {
                        // Populate the modal with the fetched data
                        $('#detailPasienNama').text(response.pasien.nama);
                        $('#detailDokterNama').text(response.dokter.nama);
                        $('#detailTanggalKunjungan').text(response.tanggal_kunjungan);
                        $('#detailKeluhan').text(response.keluhan || '-');
                        $('#detailDiagnosis').text(response.diagnosis || '-');
                        $('#detailTindakan').text(response.tindakan || '-');

                        // Simpan id kunjungan pada modal untuk digunakan saat edit
                        $('#edit_kunjungan_id').val(
                        id); // Menyimpan id kunjungan untuk digunakan di form edit

                        // Open the modal
                        $('#detailPasienModal').removeClass('hidden');
                    },
                    error: () => {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat mengambil data.', 'error');
                    }
                });
            });

            // Tombol Edit di modal detail
            $('#editDetailButton').on('click', function() {
                // Ambil id kunjungan dari modal detail yang sudah disimpan
                const kunjunganId = $('#edit_kunjungan_id').val();

                // Set nilai form edit modal
                $('#edit_pasien_id').val($('#detailPasienNama').text()); // Ganti dengan data yang sesuai
                $('#edit_kunjungan_id').val(kunjunganId);

                // Isi form dengan data kunjungan yang ingin diedit
                $('#edit_keluhan').val($('#detailKeluhan').text());
                $('#edit_diagnosis').val($('#detailDiagnosis').text());
                $('#edit_tindakan').val($('#detailTindakan').text());

                // Tampilkan modal edit detail
                $('#editDetailPasienModal').removeClass('hidden');
            });

            // Menangani submit form edit
            $('#editPasienForm').on('submit', function(e) {
                e.preventDefault();

                const kunjunganId = $('#edit_kunjungan_id').val();
                $.ajax({
                    url: `/pasienvisit/${kunjunganId}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: (response) => {
                        $('#editDetailPasienModal').addClass('hidden');
                        Swal.fire('Berhasil!', response.message, 'success');
                        $('#pasienTable').DataTable().ajax.reload();
                    },
                    error: (xhr) => {
                        Swal.fire('Gagal!', xhr.responseJSON?.message || 'Terjadi kesalahan.',
                            'error');
                    }
                });
            });

            // Close Modals
            $('#closeDetailModalButton').on('click', () => {
                $('#detailPasienModal').addClass('hidden');
            });

            $('#closeEditDetailModalButton').on('click', () => {
                $('#editDetailPasienModal').addClass('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === document.getElementById('detailPasienModal')) {
                    $('#detailPasienModal').addClass('hidden');
                }
            });
            // Handle Delete Button Click
            $('#pasienTable').on('click', '.deleteButton', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/pasienvisit/${id}`,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: (response) => {
                                table.ajax.reload();
                                Swal.fire('Berhasil!', response.message, 'success');
                            },
                            error: () => {
                                Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
