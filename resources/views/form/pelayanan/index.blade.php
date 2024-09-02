@extends('layouts.dashboard')
@section('content')
    @include('alert.alert')
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <a href="{{ route($role . '.pelayanan_create') }}" class="btn btn-secondary btn-round">Add Layanan</a>
                <thead>


                    <tr>
                        <th>No</th>
                        <th>Gambar layanan</th>
                        <th style="width: 20%; text-align: center;">Pelayanan</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($pelayanan as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td >
                                <img src="{{ asset($item->gambar_layanan) }}" style="height:60px"
                                    class="rounded img-thumbnail mb-2 mt-2" alt="gambar layanan">
                            </td>
                            <td class="text-center">{!! $item->nama_pelayanan !!}</td>
                            <td>{!! $item->deskripsi !!}</td>
                            <td>
                            @if($item->is_active == 1)
                            Aktif
                            @else
                            Tidak Aktif
                            @endif
                            </td>
                            <td style="width: 30%;">


                                <a href="{{route($role.'.pelayanan_edit', $item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>

                                <form action="{{ route($role . '.pelayanan_destroy', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('apakah anda ingin menghapus ?')">delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-center">
                            @if ($pelayanan->count() > 0)
                            @else
                                Data masih kosong
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

