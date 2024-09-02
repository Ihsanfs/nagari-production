@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <form action="{{ route($role.'.download_store') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label>judul download</label>
                    <input type="text" name="judul_download" class="form-control" placeholder="Enter donwload">
                </div>

                <div id="gambar-slider-inputs">
                    <div class="form-group">
                        <label>File download</label>
                        <input type="file" name="file_download" class="form-control" accept="image/*,.pdf">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" id="" class="form-control">
                        <option value=""  disabled selected>Pilih Status</option>
                        <option value="1">publish</option>
                        <option value="0">draft</option>


                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


