@extends('layouts.dashboard')
@section('content')
    <div class="card-body">
        @if ($danapertahun->isNotEmpty())
        <h1>Cari Total Pengeluaran berdasarkan Tahun</h1>
        <div class="row">

            <div class="col-md-4">
            <select name="" id="tahun" class="form-control">
                <option value="" selected>Pilih Tahun</option>
                @foreach ($danapertahun as $data)
                <option value="{{$data->tahun}}">{{$data->tahun}}</option>
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
        <div class="table-responsive ">

            <table id="basic-datatables" class="display table table-striped table-hover">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagcreate">
                        Create
                    </button>
                @endif

                @foreach ($transaksi->groupBy('id_dana') as $idDana => $transaksiPerDana)
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sumber dana</th>
                            <th>Jenis Pengeluaran</th>
                            <th>Pengeluaran</th>
                            <th>Deskripsi</th>

                            <th>Tanggal</th>
                            <td>Total Sisa Dana</td>
                            <th style="width: 100%; text-align:center;">action</th>

                            <th style="width: 50%">Download</th>

                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $totalTransaksi = 0;
                            $totalTransaksiPengeluaran = 0;
                            $totalled = 0;
                        @endphp
                        @foreach ($transaksiPerDana as $key => $item)
                            @php
                                $totalTransaksi++;
                                $totalTransaksiPengeluaran += $item->total_transaksi;
                                $totalled = $item->total - $totalTransaksiPengeluaran;

                            @endphp
                            @if ($loop->first)
                                <tr style="border-top: 2px solid #ff0707;">
                                @else
                                <tr style="background-color: #f9f9f9;">
                            @endif
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->dana->sumber_dana }}</td>
                                <td>{{ $item->jenis_transaksi }}</td>
                                <td>{{ number_format($item->total_transaksi, 2) }}</td>
                                <td>{{ $item->deskripsi }}</td>

                                <td>{{ $item->tanggal }}</td>
                                <td>

                                    <span
                                        class="badge
                                    @if ($item->total - $item->total_transaksi < 0) bg-danger
                                    @elseif ($item->total - $item->total_transaksi > 0)
                                        bg-success
                                    @else
                                        bg-primary @endif">
                                        {{ number_format($item->total - $item->total_transaksi, 2) }}
                                    </span>

                                </td>

                                <td style="width: 100%; text-align:center;">
                                    <div class="row">
                                        <div class="col-6 col-md-6 mb-2 mb-md-0">
                                            <button type="button" class="btn btn-sm badge badge-dark mr-4"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">Edit</button>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <form action="{{ route($role . '.transaksi_delete', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm badge badge-danger "
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                                <td><a href="{{ asset($item->file_transaksi) }}" class="badge badge-dark">Download</a></td>

                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit
                                                    Transaksi Dana</h5>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route($role . '.transaksi_update', $item->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="nama_transaksi">Sumber dana</label>
                                                        <select name="jenis_transaksi" class="form-control">
                                                            @foreach ($sumberdana as $dana)
                                                                <option value="{{ $dana->id }}"
                                                                    @if ($item->id_dana == $dana->id) selected @endif>
                                                                    {{ $dana->sumber_dana }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="tanggal_dana">Nama
                                                            Pengeluaran</label>
                                                        <input type="text" name="nama_pengeluaran" class="form-control"
                                                            value="{{ $item->jenis_transaksi }}" />
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="total_pengeluaran">Total
                                                            Pengeluaran</label>
                                                        <input type="text" name="total_pengeluaran" class="form-control"
                                                            value="{{ $item->total_transaksi }}" />
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="tanggal_transaksi">Tanggal</label>
                                                        <input type="date" name="tanggal_transaksi"
                                                            value="{{ $item->tanggal }}" class="form-control" />
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label"
                                                            for="transaksi_deskripsi">Deskripsi</label>
                                                        <textarea name="transaksi_deskripsi" id="" cols="30" rows="10" class="form-control">{{ $item->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="file_transaksi">Dokumen Saat
                                                            Ini</label>
                                                        <input type="text" class="form-control"
                                                            value="
                                                        @if ($item->file_transaksi) {{ $item->file_transaksi }}
                                                        @else
                                                        Dokumen Kosong @endif
                                                        "
                                                            readonly />
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="file_transaksi">Dokumen</label>
                                                        <input type="file" name="file_transaksi" class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value=""
                                                                {{ $item->status == null ? 'selected' : '' }} disabled>
                                                                Select Status</option>
                                                            <option value="{{ $item->status == 1 }}"
                                                                {{ $item->status == 1 ? 'selected' : '' }}>Published
                                                            </option>
                                                            <option value="{{ $item->status == 0 }}"
                                                                {{ $item->status == 0 ? 'selected' : '' }}>Draft</option>
                                                        </select>
                                                    </div>




                                                    <button type="submit"
                                                        class="btn btn-primary btn-block">Submit</button>
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
                        <tr>
                            <td colspan="2" rowspan="3">Total Transaksi: {{ $totalTransaksi }}</td>
                            <td></td>

                            <td>Total Pengeluaran : <span
                                    class="badge bg-warning">{{ number_format($totalTransaksiPengeluaran, 2) }}</span>


                            </td>
                            <td colspan="2"></td>
                            <td>Total Sisa Dana : <span
                                    class="badge
                            @if ($totalled < 0) bg-danger @elseif ($totalled > 0) bg-success @else bg-primary @endif">
                                    {{ number_format($totalled, 2) }}
                                </span></td>

                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>



        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="tagcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="modal-body p-4">
                            <form action="{{ route($role . '.transaksi_store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="jenis_transaksi">Sumber Dana</label>
                                    <select name="jenis_transaksi" class="form-control">
                                        <option value="" selected disabled>Pilih Sumber Dana</option>
                                        @foreach ($sumberdana as $dana)
                                            <option value="{{ $dana->id }}">{{ $dana->sumber_dana }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama_pengeluaran">Nama Pengeluaran</label>
                                    <input type="text" name="nama_pengeluaran" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="total_pengeluaran">Total Pengeluaran</label>
                                    <input type="text" name="total_pengeluaran" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="transaksi_deskripsi">Deskripsi</label>
                                    <textarea name="transaksi_deskripsi" class="form-control" cols="30" rows="10"></textarea>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="file_transaksi">Dokumen</label>
                                    <input type="file" name="file_transaksi" class="form-control" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="tanggal_transaksi">Tanggal</label>
                                    <input type="date" name="tanggal_transaksi" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1">Published</option>
                                        <option value="0">Draft</option>
                                    </select>
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
                url: '/' + role + '/transaksitahunan/' + tahun,
                success: function(response) {
                    console.log(response);
                    if (response.length > 0) {
                        let html = '<div>';
                        response.forEach(function(data) {
                            html += `
                            <h3 class="mb-2">Total Pengeluaran Rp. ${data.total.toLocaleString()}</h3>
                            <h4>Dana Bersih Rp. ${(data.totalmasuk - data.total).toLocaleString()}</h4>
                            <h4>Dana Kotor Rp. ${data.totalmasuk.toLocaleString()} </h4>
                            <h3> Jumlah Pengeluaran tahun ${data.tahun}</h3>
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


