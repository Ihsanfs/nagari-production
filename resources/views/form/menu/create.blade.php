@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<style>
    #url_menu{
        display: none;
    }

    #urut{
        display: none;
    }
</style>
<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <form action="{{route($role.'.menu_store')}}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_menu" class="form-control" placeholder="Nama menu">
                </div>

                <div class="form-group">
                    <label>Pilih status menu</label>
                    <select name="menu_pilih" id="menu_pilih" class="form-control">
                        <option value=""  disabled selected>Pilih Status menu</option>
                        <option value="1">internal</option>
                        <option value="2">tunggal</option>
                        <option value="3">internal/eksternal</option>
                        <option value="4">single page</option>
                    </select>
                </div>

                <div class="form-group" id="url_menu">
                    <label>URL</label>
                    <input type="text" name="url_menu" class="form-control">
                </div>

                <div class="form-group" id="deskripsi" style="display: none;">
                    <label for="deskripsi_h">Deskripsi</label>
                    <textarea name="deskripsi_page" class="form-control" id="editor1" rows="5" placeholder="deskripsi"></textarea>
                </div>
                <div class="form-group" id="gambar_page" style="display: none;">
                    <label for="gambar_page">Gambar</label>
                    <input type="file" class="form-control-file" name="gambar_page" >
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value=""  disabled selected>Pilih Status</option>
                        <option value="1">publish</option>
                        <option value="0">draft</option>
                    </select>
                </div>


            <div class="form-group" id="urut">
                <label for="">Urut Menu</label>
                <input type="number" class="form-control" name="urut" >
            </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#url_menu').hide();

        $('#menu_pilih').change(function () {
            var menu_pilih = parseInt($(this).val());
            if (menu_pilih == 2) {
                $('#url_menu').show();
                $('#urut').show();
            } else {
                $('#url_menu').hide();
                $('#urut').show();

            }


            if (menu_pilih == 4) {
                $('#deskripsi').show();
                $('#gambar_page').show();
                $('#urut').show();

            } else {
                $('#deskripsi').hide();
                $('#gambar_page').hide();
                $('#urut').show();


            }
        });
    });
</script>

@push('scripts')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>

    $(document).ready(function() {
        var config = {
        sourceAreaTabSize: 8,
        versionCheck: false
    };

        CKEDITOR.replace('editor1', {
            config,
            removeButtons: 'PasteFromWord',
            baseFloatZIndex: 10005,
            filebrowserUploadUrl: "{{ route($role . '.berita_upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',

        });

    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@endpush
