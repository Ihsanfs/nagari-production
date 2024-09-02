@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
    <div class="container">
        <h2 class="text-dark">Profil Instansi</h2>
        <div class="col-6 col-md-12 ml-auto text-right">
            @if($instansi)
                <a href="{{ route($role.'.instansi_edit', $instansi->first()->id) }}" class="btn btn-warning">Edit Profil</a>
            @else
                <a href="{{ route($role.'.instansi_create') }}" class="btn btn-warning">Buat Profil</a>
            @endif
        </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



        @if($instansi)
        <div class="row py-4">

                <div class="col-12 col-md-6 mb-2">

                    <div class="form-group">
                        <label for="nama">Nama Kepala Instansi</label>
                        <input type="text" class="form-control" value="{{$instansi->nama}}" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Sambutan</label>
                    <textarea name="sambutan" id="editor1" cols="30" class="form-control"  rows="10"  readonly>{!! $instansi->sambutan !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_instansi">Deskripsi Instansi</label>
                    <textarea  id="editor2" cols="30" class="form-control"  rows="10"  readonly>{!! $instansi->deskripsi_profil !!}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="sosial_media">Sosial Media (Berupa URL)</label>
                        @foreach ($media as $item)
                            <input type="text" class="form-control mb-2"  value="{{ $item->sosmed->nama_sosmed }}" readonly>
                        @endforeach
                    </div>



                    <div class="form-group ">
                        <label for="kecamatan">Kecamatan</label>
                        <textarea class="form-control" name="kecamatan" cols="50" rows="10" readonly>{{$instansi->kecamatan}}</textarea>

                    </div>
                </div>

                <div class="col-12 col-md-6 mb-2">

                    <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <textarea class="form-control" id="kabupaten" name="kabupaten" cols="50" rows="10" readonly>{{$instansi->kabupaten}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="nagari">Nagari/Kelurahan/Desa</label>
                        <textarea class="form-control" name="nagari" cols="50" rows="10" readonly>{{$instansi->nagari}}</textarea>
                    </div>
                </div>


                <div class="col-12 col-md-6 mb-2 h-50">
                    <div class="form-group d-flex flex-column align-items-center">
                        <label for="foto_instansi" class="mb-2">Kantor</label>
                        <img src="{{ asset($instansi->foto_instansi) }}" alt="Foto Instansi" class="mb-2" style="max-width: 300px;">
                    </div>
                </div>



                <div class="col-12 col-md-6 mb-2 h-50">
                    <div class="form-group d-flex flex-column align-items-center">
                        <label for="foto_kepala" class="mb-2">Foto kepala Instansi</label>
                        <img src="{{ asset($instansi->foto_kepala) }}" alt="foto_kepala" class="mb-2" style="max-width: 300px;">
                    </div>
                </div>


        </div>
        @endif
    </div>
@endsection
@push('scripts')

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        var config = {
        sourceAreaTabSize: 8,
        versionCheck: false
    };
        CKEDITOR.replace('editor1', config);
        CKEDITOR.replace('editor2', config);

    });
</script>
@endpush
