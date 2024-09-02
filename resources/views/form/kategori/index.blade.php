
@extends('layouts.dashboard')
@section('content')
<div class="card-body">

    @include('alert.alert')
    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover" >
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

            <a href="{{ route($role . '.kategori_add') }}" class="btn btn-secondary btn-round">Add Kategori</a>
        @endif


            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>slug</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($kategori as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->nama_kategori}}</td>
                    <td>{{$item->slug}}</td>
                    <td>

                        <a href="{{ route($role. '.edit_kategori', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> edit</a>

                        <form action="{{ route($role. '.hapus_kategori', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-xs"  onclick="return confirm('apakah anda ingin menghapus ?')">delete</button>
                            </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
