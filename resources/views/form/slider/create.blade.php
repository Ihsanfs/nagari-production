@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <form action="{{ route($role.'.slider_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul_slider" class="form-control" placeholder="Enter judul">
                </div>

                <div id="gambar-slider-inputs">
                    <div class="form-group">
                        <label>Gambar Slider</label>
                        <input type="file" name="gambar_slider" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="1">Publish</option>
                        <option value="0">Draft</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


