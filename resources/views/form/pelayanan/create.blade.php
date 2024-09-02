@extends('layouts.dashboard')
@section('content')
    @include('alert.alert')
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <form action="{{ route($role . '.pelayanan_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Pelayanan</label>
                        <input type="text" name="nama_pelayanan" class="form-control" placeholder="Nama Pelayanan">
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Gambar Pelayanan</label>
                        <input type="file" name="gambar_layanan" class="form-control" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="editor1" cols="30" rows="10"></textarea>

                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" id="" class="form-control">
                            <option value="" disabled selected>Pilih Status</option>
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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>

        $(document).ready(function() {
            var config = {};
            config.sourceAreaTabSize = 8;

            CKEDITOR.replace('editor1', {
                config,
                removeButtons: 'PasteFromWord',
                baseFloatZIndex: 10005,
                filebrowserUploadUrl: "{{ route($role . '.berita_upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form',

            });

        });
    </script>

@endpush
