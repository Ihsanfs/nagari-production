@extends('layouts.dashboard')
@section('content')
    <div class="card-body">
        @if ($danapertahun->isNotEmpty())
        <h1>Cari Total Pemasukan berdasarkan Tahun</h1>
        <div class="row">

            <div class="col-md-4">
                <select name="" id="tahun" class="form-control">
                    <option value="" selected>Pilih Tahun</option>
                    @foreach ($danapertahun as $data)
                        <option value="{{ $data->tahun }}">{{ $data->tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <div class="card card-dark bg-info-gradient">
                    <div class="card-body pb-0" id="transaksi">
                        <h4>Tidak Ada Tahun Yang di Pilih</h4>

                    </div>
                </div>
            </div>

        </div>
        @endif


        @include('alert.alert')
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagcreate">
                        Create
                    </button>
                @endif


                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sumber dana</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Donwload</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sumberdana as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->sumber_dana }}</td>
                            <td>{{ number_format($item->total, 2) }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td><a href="
                                @if ($item->file_dana < 0) {{ route($role . '.sumber_dana') }}
                                @else
                                {{ asset($item->file_dana) }} @endif
                                "
                                    class="badge badge-dark">Download</a></td>
                            <td>

                                {{-- <a href="{{ route($role. '.edit_tag', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> edit</a> --}}
                                <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <form action="{{ route($role . '.sumber_delete', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-xs"
                                        onclick="return confirm('apakah anda ingin menghapus ?')">delete</button>
                                </form>
                            </td>
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Sumber Dana
                                            </h5>
                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route($role . '.sumber_update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="nama_dana">Nama Sumber Dana</label>

                                                    <input type="text" name="nama_dana" class="form-control"
                                                        value="{{ $item->sumber_dana }}" />
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="tanggal_dana">Tanggal</label>
                                                    <input type="date" name="tanggal_dana" class="form-control"
                                                        value="{{ $item->tanggal }}" />
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="tanggal_dana">Dokumen Saat Ini</label>
                                                    <input type="text" class="form-control"
                                                        value="
                                                        @if ($item->file_dana) {{ $item->file_dana }}
                                                        @else
                                                        Dokumen Kosong @endif
                                                        "
                                                        readonly />
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="file_dana">Dokumen</label>
                                                    <input type="file" name="file_dana" class="form-control" />
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="dana_total">Jumlah Dana</label>
                                                    <input type="text" name="dana_total" class="form-control"
                                                        value="{{ $item->total }}" />
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="dana_deskripsi">Deskripsi</label>
                                                    <textarea name="dana_deskripsi" id="" cols="30" rows="10" class="form-control">{{ $item->deskripsi }}</textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="tagcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Sumber Dana</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="modal-body p-4">
                            <form action="{{ route($role . '.sumber_store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama_dana">Nama Sumber Dana</label>

                                    <input type="text" name="nama_dana" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="tanggal_dana">Tanggal</label>
                                    <input type="date" name="tanggal_dana" class="form-control" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="file_dana">Dokumen</label>
                                    <input type="file" name="file_dana" class="form-control" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="dana_total">Jumlah Dana</label>
                                    <input type="text" name="dana_total" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="dana_deskripsi">Deskripsi</label>
                                    <textarea name="dana_deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#tahun').change(function() {
                let tahun = $(this).val();
                let tampil = '#transaksi';
                let role = "{{ $role }}";
                if (tahun === "") {
                    $(tampil).html(`<h4> Tidak Ada Transaksi</h4>`);
                    return;
                }
                $.ajax({
                    type: "GET",
                    url: '/' + role + '/transaksimasuk/' + tahun,
                    success: function(response) {
                        console.log(response);
                        if (response.length > 0) {
                            let html = '<div>';
                            response.forEach(function(data) {
                                html += `
                            <h3 class="mb-2">Total Pemasukan Rp. ${data.total.toLocaleString()}</h3>

                            <h3> Jumlah Pemasukan tahun ${data.tahun}</h3>
                            `;
                            });
                            html += '</div>';
                            $(tampil).html(html);
                        } else {
                            $(tampil).html(`<h4> Tidak Ada Transaksi</h4>`);
                        }
                    }
                });
            });
        });
    </script>
