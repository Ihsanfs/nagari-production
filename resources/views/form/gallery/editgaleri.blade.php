
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <h2>Edit galeri</h2>
    <div class="row">

        <div class="col-md-6 col-lg-6">
            <form action="{{route($role.'.galery_update', $gallery->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="form-group">
                <label>judul</label>
                <input type="text" name="judul"  class="form-control" value="{{$gallery->nama}}" placeholder="Enter judul">
            </div>



            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_galery" class="form-control" >
            </div>

            <div class="form-group">
                <label>Gambar sekarang</label>
            <img width="150px"  src="{{asset($gallery->gambar_galery)}}">

        </div>

        <div class="form-group">
            <label>status</label>
            <select name="is_active" class="form-control">
                <option value="" {{ $gallery->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                <option value="1" {{ $gallery->is_active == '1' ? 'selected' : '' }}>publish</option>
                <option value="0" {{ $gallery->is_active == '0' ? 'selected' : '' }}>draft</option>
            </select>
        </div>


            <button type="submit" class="btn btn-primary">Send message</button>

        </form>
            </div>

    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
