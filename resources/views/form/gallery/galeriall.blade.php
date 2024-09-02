@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">
        @foreach ($gambar as $key => $item)
        <div class="col-md-4 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{$item->nama}}</h5>
                    <img src="{{asset($item->gambar_galery)}}" class="img-fluid" style="max-width: 100%; height: auto;">
                    <div class="mt-2 p-2">
                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <a href="{{ route($role . '.galery_edit', ['id' => $item->id]) }}"
                                    class="btn btn-warning btn-sm btn-block">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route($role . '.galery_destroy', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-block"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
