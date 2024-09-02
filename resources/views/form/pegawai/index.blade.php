@extends('layouts.dashboard')
@section('content')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    @include('alert.alert')
    <a href="{{ route($role . '.pegawai_create') }}" class="btn btn-secondary btn-round">Add pegawai</a>
    <div class="card-body">
        <div class="pegawai">

            <div class="table-responsive">
                <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 20%;">Nama</th>
                            <th style="width: 15%;">Jabatan</th>
                            <th style="width: 15%;">Gambar</th>
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 20%;">Alamat</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 100%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @foreach ($pegawai as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Slider</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route($role . '.pegawai_update', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_pegawai">Judul</label>
                                <input type="text" name="nama_pegawai" class="form-control" placeholder="Enter judul"
                                    value="{{ $item->nama_pegawai }}">
                            </div>

                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" placeholder="Enter judul"
                                    value="{{ $item->jabatan }}">
                            </div>
                            <div class="form-group">
                                <label for="">Gambar Saat ini</label>
                                <img src="{{ asset($item->gambar_pegawai) }}" class="img-fluid"
                                    style="max-width: 100%; max-height: 200px;">
                            </div>
                            <input type="file" name="gambar_pegawai" class="form-control" accept="image/*,.pdf" multiple>

                            <div class="form-group">
                                <input type="date" class="form-control" name="tanggal" value="{{ $item->tanggal }}">
                            </div>

                            <div class="form-group">
                                <textarea name="alamat" name="alamat" class="form-control" cols="30" rows="10">{{ $item->alamat }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="" {{ $item->is_active == null ? 'selected' : '' }} disabled>Select
                                        Status</option>
                                    <option value="1" {{ $item->is_active == '1' ? 'selected' : '' }}>Published
                                    </option>
                                    <option value="0" {{ $item->is_active == '0' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Datatables -->
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@push('scripts')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tbl_list').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'csv',
                            title: 'Data Pegawai',
                            exportOptions: {
                                columns: [0, 1, 2, 4, 5]
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Data Pegawai',
                            exportOptions: {
                                columns: [0, 1, 2, 4, 5]
                            }
                        },

                    ],
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url()->current() }}',
                    language: {
                        emptyTable: "Tidak ada data"
                    },
                    data: [], 
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nama_pegawai',
                            name: 'nama_pegawai',
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan',
                        },
                        {
                            data: 'gambar_pegawai',
                            name: 'gambar_pegawai',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return `<img src="{{ asset('${data}') }}" alt="Gambar Pegawai" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">`;
                                } else {
                                    return data;
                                }
                            }
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal',
                        },
                        {
                            data: 'alamat',
                            name: 'alamat',
                        },
                        {
                            data: 'is_active',
                            name: 'is_active',
                            render: function(data, type, row) {
                                return data == 1 ? 'Aktif' : 'Tidak Aktif';
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, item) {
                                return `
                                    <div class ="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editModal${item.id}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <form action="{{ route($role . '.pegawai_destroy', ':id') }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda ingin menghapus?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                `.replace(':id', item.id);
                            }
                        }
                    ]
                });
            });
        </script>

@endpush
