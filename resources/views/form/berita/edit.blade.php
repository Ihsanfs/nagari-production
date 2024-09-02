
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <form action="{{ route($role.'.berita_update', $berita->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method ('put')
            <div class="form-group">
                <label>judul</label>
                <input type="text" name="judul" value="{{$berita->judul}}" class="form-control" placeholder="Enter judul">
            </div>

            <div class="form-group">
                <label>isi</label>

                <textarea name="body" id="editor1"  cols="30" rows="10">{!! $berita->body !!}</textarea>

            </div>

            {{-- <div class="form-group">
                <label>Kategori</label>

                <select name="kategori_id" id="" class="form-control">
                    @if($berita->id)
                        <option value="" disabled selected>Pilih Kategori</option>
                    @endif
                    @foreach ($kategori_all as $item)
                        <option value="{{$item->id}}" {{ $item->id == $berita->kategori_id ? 'selected' : '' }}>
                            {{$item->nama_kategori}}
                        </option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="tag_id">Tag</label>
                <select name="tag_id[]" class="form-control js-example-tokenizer" multiple="multiple">
                    @foreach ($tag_all as $tag)
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) selected @endif>{{ $tag->nama_tag }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tag_id">Kategori</label>
                <select name="kategori_id[]" class="form-control js-example-tokenizer" multiple="multiple">
                    @foreach ($kategori_all as $kategori)
                        <option value="{{ $kategori->id }}" @if(in_array($kategori->id, $kategori_artikel)) selected @endif>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>




            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_file"  class="form-control" >


            </div>
            <div class="form-group">
                <label>Gambar sekarang</label>
            <img width="150px"  src="{{asset($berita->gambar_artikel)}}">

        </div>

        <br>
        <div class="form-group">
            <label for="tanggal">
                Tanggal
            </label>
            <input type="date" name="tanggal" value="{{$berita->tanggal}}" class="form-control">

        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="" {{ $berita->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                <option value="1" {{ $berita->is_active == '1' ? 'selected' : '' }}>Publish</option>
                <option value="0" {{ $berita->is_active == '0' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>




            <button type="submit" class="btn btn-primary">Send message</button>

        </form>
            </div>

        </div>
    </div>
@endsection
<script src="https://fastly.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')
<script src="https://fastly.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://fastly.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
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
            versionCheck: false
        });

    });
</script>
@endpush
