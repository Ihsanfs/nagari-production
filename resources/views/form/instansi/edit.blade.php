@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
    <div class="container">
        <h2 class="text-dark">Profil Instansi</h2>
        <div class="row py-4">

                <div class="col-12 col-md-6 mb-2">

                    <form action="{{ route($role.'.instansi_update', $instansi->id) }}" class="col-md-auto" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <label for="nama">Nama Kepala Instansi</label>
                        <input type="text" class="form-control" value="{{$instansi->nama}}" name="nama">
                    </div>

                    <div class="form-group">
                        <label for="nama">Sambutan</label>
                    <textarea name="sambutan" id="editor1" cols="30" class="form-control"  rows="10" value="{!! $instansi->sambutan !!}" >{{$instansi->sambutan}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_profil">Deskripsi Profil</label>

                    <textarea name="deskripsi_profil" id="editor2" class="form-control" cols="30" value="{!! $instansi->deskripsi_profil !!}"  rows="10" >{!! $instansi->deskripsi_profil !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="sosial_media">Sosial Media (Berupa URL)</label>
                        <div id="sosmed-inputs">
                            @if($media->isEmpty())
                                <div class="row mb-2">
                                    <div class="col-md-3 mb-2">
                                        <select class="form-control media-select" name="media[]">
                                            <option value="" selected disabled hidden>Pilih Medsos</option>

                                            @foreach ($media_data as $option)
                                                <option value="{{ $option->id }}">{{ $option->nama_sosmed }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <input type="text" class="form-control" name="sosmed_url[]" value="">
                                    </div>
                                </div>
                            @else
                                @foreach ($media as $social_media)
                                    <div class="row mb-2">
                                        <div class="col-md-3 mb-2">
                                            <select class="form-control media-select" name="media[]">
                                                <option value="" selected disabled hidden>Pilih Medsos</option>


                                                @foreach ($media_data as $option)
                                                    <option value="{{ $option->id }}" {{ $option->id == $social_media->sosial_media_id ? 'selected' : '' }}>
                                                        {{ $option->nama_sosmed }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                            <div class="col-md-7 mb-2">
                                                <input type="text" class="form-control" name="sosmed_url[]" value="{{ $social_media->url }}">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <button type="button" class="btn btn-danger mt-md-0 mt-2 remove-media" data-id="{{ $social_media->id }}">Hapus</button>
                                            </div>


                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="button" class="btn btn-primary mt-md-0 mt-2" id="add-sosmed">Tambah URL Sosial Media</button>
                    </div>













                    <div class="form-group ">
                        <label for="kecamatan">Kecamatan</label>
                        <textarea class="form-control" name="kecamatan" cols="50" rows="10">{{$instansi->kecamatan}}</textarea>

                    </div>


                </div>

                <div class="col-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <textarea class="form-control" id="kabupaten" name="kabupaten" cols="50" rows="10">{{$instansi->kabupaten}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="nagari">Nagari/Kelurahan/Desa</label>
                        <textarea class="form-control" name="nagari" cols="50" rows="10">{{$instansi->nagari}}</textarea>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-2 h-50">
                    <div class="form-group d-flex flex-column align-items-center">
                        <label for="foto_instansi" class="mb-2">Kantor</label>
                        <img src="{{ asset($instansi->foto_instansi) }}" alt="Foto Instansi" class="mb-2" style="max-width: 300px;">
                        <input type="file" class="form-control-file mt-2" name="gambar_instansi">
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-2 h-50">
                    <div class="form-group d-flex flex-column align-items-center">
                        <label for="foto_kepala" class="mb-2">Foto kepala Instansi</label>
                        <img src="{{ asset($instansi->foto_kepala) }}" alt="Foto kepala" class="mb-2" style="max-width: 300px;">
                        <input type="file" class="form-control-file mt-2" name="gambar_kepala">
                    </div>
                </div>

                <div class="col-12 col-md-12 mb-2">
                    <button class="btn btn-info col-md-12">Update</button>
                </div>
            </form>
        </div>
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
<script>
    $(document).ready(function() {
        // Function to handle adding new social media inputs
        $('#add-sosmed').on('click', function() {
            var newInput = `
            <div class="row mb-2">
                <div class="col-md-3 mb-2">
                    <select class="form-control media-select" name="media[]">
                        <option value="" selected disabled hidden>Pilih Medsos</option>

                        @foreach ($media_data as $social_media)
                            <option value="{{ $social_media->id }}">{{ $social_media->nama_sosmed }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-7 mb-2">
                    <input type="text" class="form-control" name="sosmed_url[]" placeholder="Masukkan URL">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger mt-md-0 mt-2 remove-media">Hapus</button>
                </div>
            </div>`;
            $('#sosmed-inputs').append(newInput);
            updateMediaSelects();
        });

        // Function to handle changes in media selects
        $(document).on('change', '.media-select', function() {
            updateMediaSelects();
        });

        // Function to handle removing media entries
        $(document).on('click', '.remove-media', function() {
            var rowToRemove = $(this).closest('.row');
            var mediaId = rowToRemove.data('media-id');

            if (mediaId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url($role.'/instansi/') }}/" + mediaId + "/remove",
                    dataType: "json",
                    success: function (response) {
                        console.log(response); // Handle success response here
                        rowToRemove.remove();
                        updateMediaSelects(); // Update the media selects after removal
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Handle error response here
                    }
                });
            } else {
                rowToRemove.remove();
                updateMediaSelects(); // Update the media selects after removal
            }
        });

        function updateMediaSelects() {
            var selectedValues = $('.media-select').map(function() {
                return $(this).val();
            }).get();

            var allSelected = true;
            var availableOptions = false;

            $('.media-select').each(function() {
                var currentSelect = $(this);
                currentSelect.find('option').each(function() {
                    var optionValue = $(this).attr('value');
                    if (optionValue && selectedValues.includes(optionValue) && optionValue !== currentSelect.val()) {
                        $(this).attr('disabled', 'disabled');
                    } else {
                        $(this).removeAttr('disabled');
                        if (optionValue && !selectedValues.includes(optionValue)) {
                            availableOptions = true;
                        }
                    }
                });

                if (currentSelect.val() === '') {
                    allSelected = false;
                }
            });

            if (!availableOptions) {
                $('#add-sosmed').hide();
            } else {
                $('#add-sosmed').show();
            }
        }

        // Initial check
        updateMediaSelects();
    });
</script>

@endpush

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


