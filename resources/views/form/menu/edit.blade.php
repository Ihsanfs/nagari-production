@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">

        <div class="col-md-8 col-lg-8">
            <form action="{{route($role.'.menu_update', $menu->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama_menu"  value = "{{$menu->nama}}"class="form-control" >
            </div>
            @if($menu->status == 2)
            <div class="form-group">
                <label>Url</label>
                <input type="text" name="url"  value = "{{$menu->url}}"class="form-control" >
            </div>
            @endif

            @if($menu->status == 4)
            @if (!empty($menu->deskripsi_page))
            <div class="form-group">
                <label for="deskripsi_h">Deskripsi</label>
                <textarea name="deskripsi_page" class="form-control" id="editor1" rows="5" placeholder="deskripsi">{{ $menu->deskripsi_page }}</textarea>
            </div>
            @else
            <div class="form-group">
                <label for="deskripsi_h">Deskripsi</label>
                <textarea name="deskripsi_page" class="form-control" id="editor1" rows="5" placeholder="deskripsi">{{ $menu->deskripsi_page }}</textarea>
            </div>
            @endif
            @if (!empty($menu->gambar_page))
            <div class="form-group">
                <label>Gambar sekarang</label>
                <img width="150px" src="{{ asset($menu->gambar_page) }}">

            </div>

            @endif
            <div class="form-group" id="gambar_page" >
                <label for="gambar_page">Gambar</label>
                <input type="file" class="form-control-file" name="gambar_page" >
            </div>
            @endif
            <div class="form-group" id="urut">
                <label for="">Urut Menu</label>
                <input type="number" class="form-control" name="urut" value="{{$menu->urutan_menu}}" >
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="" {{ $menu->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                    <option value="1" {{ $menu->is_active == '1' ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ $menu->is_active == '0' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
            </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
