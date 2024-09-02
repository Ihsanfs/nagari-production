
@extends('layouts.dashboard')
@section('content')
<div class="card-body">

    @include('alert.alert')

    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover" >
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

            <a href="{{ route($role . '.halaman_create') }}" class="btn btn-secondary btn-round">Add Halaman</a>
        @endif


            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Judul</th>
                    <th>Author</th>
                    <th>Deskripsi</th>
                    <th>status</th>
                    <th>Urutan Halaman</th>
                    <th>Tanggal</th>

                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($halaman as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @if($item->menu_nama)

                            {{ $item->menu_nama->nama }}
                            @if($item->menu_nama->status == 1)
                            <span class="badge badge-success">internal</span>
                     @endif

                     @if($item->menu_nama->status == 3)
                            <span class="badge badge-primary">internal/eksternal</span>
                     @endif
                        @else
                            Menu tidak ada
                        @endif
                    </td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->author_halaman->name}}</td>
                    <td>{{ Str::limit($item->deskripsi, 10) }}</td>
                    <td>
                        @if($item->is_active == 1)
                            Publish
                        @else
                            Draft
                        @endif

                    </td>
                    <td>{{$item->page_halaman}}</td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>

                        <a href="{{ route($role. '.halaman_edit', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> edit</a>

                        <form action="{{ route($role. '.halaman_delete', $item->id) }}"  style="display: inline;" method="POST">
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
    {!! $halaman->render() !!}

</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
