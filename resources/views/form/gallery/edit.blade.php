
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <h2>Edit Album</h2>
    <div class="row">


        <div class="col-md-6 col-lg-6">
            <form action="{{route($role.'.album_update', $album->id)}}" method="POST" enctype="multipart/form-data">

                @method('PUT')
                @csrf
            <div class="form-group">
                <label>judul</label>
                <input type="text" name="judul"  class="form-control" value="{{$album->nama_album}}" placeholder="Enter judul">
            </div>



            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_album" class="form-control" >
            </div>

            <div class="form-group">
                <label>Gambar sekarang</label>
            <img width="150px"  src="{{asset($album->album_image)}}">

        </div>

        <div class="form-group">
            <label>status</label>
            <select name="is_active" class="form-control">
                <option value="" {{ $album->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                <option value="1" {{ $album->is_active == '1' ? 'selected' : '' }}>publish</option>
                <option value="0" {{ $album->is_active == '0' ? 'selected' : '' }}>draft</option>
            </select>
        </div>


            <button type="submit" class="btn btn-primary">Send message</button>

        </form>
            </div>

    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
