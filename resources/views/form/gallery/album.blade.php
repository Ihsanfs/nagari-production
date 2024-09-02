
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">

        <div class="col-md-6 col-lg-6">
            <form action="{{route($role.'.album_store')}}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
            <div class="form-group">
                <label>judul</label>
                <input type="text" name="judul_album"  class="form-control" placeholder=" buat judul album" required>
            </div>


            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_album" class="form-control" required>
            </div>


            <div class="form-group">
                <label>status</label>
                <select name="is_active" id="" class="form-control" required>
                    <option value=""  disabled selected>Pilih Status</option >
                    <option value="1">publish</option>
                    <option value="0">draft</option>


                </select>

            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
            </div>

    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
