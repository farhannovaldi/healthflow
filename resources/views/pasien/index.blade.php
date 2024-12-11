@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <div class="bg-white shadow-md rounded p-6">
        <table id="pasienTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#pasienTable').DataTable({
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
                                <a href="${editUrl}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="${deleteUrl}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            `;
                        }
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>
@endsection
