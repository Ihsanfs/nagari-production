

@extends('layouts.dashboard')
@section('content')

<link rel="stylesheet" href="https://fastly.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

<div class="card-body">
    @include('alert.alert')
    <div class="row">

        <div class=" col-6 col-md-12">

            <form action="{{route($role.'.berita_store')}}" method="POST" enctype="multipart/form-data">

                @csrf
            <div class="form-group">
                <label>judul</label>
                <input type="text" name="judul"  class="form-control" placeholder="Enter judul">
            </div>

            <div class="form-group">
                <label>isi</label>
                <textarea name="body" id="editor1"  cols="30" rows="10"></textarea>

            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id[]"  class="form-control js-example-tokenizer"  multiple="multiple">

                    @foreach ($kategori_all as $item)
                    <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tag</label>
                <select name="tag_id[]"  class="form-control js-example-tokenizer"  multiple="multiple">

                    @foreach ($tag as $item)
                        <option value="{{$item->id}}">{{$item->nama_tag}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">
                    Tanggal
                </label>
                <input type="date" name="tanggal" class="form-control">

            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_file"  class="form-control" >
            </div>


            <div class="form-group">
                <label>Status</label>
                <select name="is_active" id="" class="form-control">
                    <option value=""  disabled selected>Pilih Status</option>
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


<script src="https://fastly.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')
<script src="https://fastly.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard-all/ckeditor.js"></script>
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
            versionCheck: false

        });

    });
</script>
@endpush
