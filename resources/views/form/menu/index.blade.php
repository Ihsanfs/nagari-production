@extends('layouts.dashboard')
@section('content')
    <div class="card-body">
        @include('alert.alert')
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <a href="{{ route($role . '.menu_create') }}" class="btn btn-secondary btn-round">Add Menu</a>
                @endif


                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Author</th>
                        <th>status</th>
                        <th>Urutan Menu</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>

                        @foreach ($menu as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $item->nama }}

                                    @if($item->status == 1)
                                    <span class="badge badge-warning">internal</span>
                                     @endif

                                    @if($item->status == 4)
                                    <span class="badge badge-success">single page (deskripsi)</span>
                                     @endif

                                    @if($item->status == 2)
                                    <span class="badge badge-primary">tunggal</span>
                                    @endif

                                    @if($item->status == 3)
                                    <span class="badge badge-secondary">internal/eksternal</span>
                                    @endif

                                </td>
                                <td>{{ $item->author_menu->name }}</td>
                                <td>  @if($item->is_active == 1)
                                    Publish
                                @else
                                    Draft
                                @endif</td>
                                <td>{{$item->urutan_menu}}</td>

                                <td>
                                    <a href="{{ route($role . '.menu_edit', $item->id) }}" class="btn btn-primary btn-xs"><i
                                            class="fa fa-edit"></i> edit</a>

                                    <form action="{{ route($role . '.menu_delete', $item->id) }}" method="POST"  style="display: inline;">
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
