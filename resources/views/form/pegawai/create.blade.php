@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <form action="{{ route($role.'.pegawai_store') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label>Nama pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai">
                </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                    </div>
                    <div class="form-group">
                        <label>tanggal</label>
                        <input type="date" name="tanggal" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>Gambar Pegawai</label>
                        <input type="file" name="gambar_pegawai" class="form-control" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
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


