@extends('layouts.dashboard')
@section('content')
    @include('alert.alert')
    <div class="container">
        <h2 class="text-dark">Profil Instansi</h2>
        <div class="row py-4">

            <div class="col-12 col-md-6 mb-2">
                <form action="{{ route($role . '.instansi_store') }}" class="col-md-auto" method="POST"
                    enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Kepala Instansi</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>

                    <div class="form-group">
                        <label for="nama">Sambutan</label>

                        <textarea name="sambutan" id="editor1" cols="30" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_profil">Deskripsi Profil</label>

                        <textarea name="deskripsi_profil" id="editor2" cols="30" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <div id="sosmed-inputs">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="sosial_media">Sosial Media (Berupa URL)</label>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select class="form-control media-select" name="media[]">
                                        <option value="" selected disabled hidden>Pilih Medsos</option>
                                        @foreach ($media as $social_media)
                                            <option value="{{ $social_media->id }}">
                                                {{ $social_media->nama_sosmed }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-7 mb-2">
                                    <input type="text" class="form-control" name="sosmed_url[]"
                                        placeholder="Masukkan URL">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="button" class="btn btn-primary mt-md-0 mt-2" id="add-sosmed">Tambah URL
                                        Sosial Media</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="form-group ">
                        <label for="kecamatan">Kecamatan</label>
                        <textarea class="form-control" name="kecamatan" cols="50" rows="10"></textarea>

                    </div>


            </div>

            <div class="col-12 col-md-6 mb-2">
                <div class="form-group">
                    <label for="kabupaten">Kabupaten</label>
                    <textarea class="form-control" id="kabupaten" name="kabupaten" cols="50" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="nagari">Nagari/Kelurahan/Desa</label>
                    <textarea class="form-control" name="nagari" cols="50" rows="10"></textarea>
                </div>
            </div>


            <div class="col-6 col-md-12 mb-2">
                <div class="row">
                    <div class="col-6 col-md-6-lg-6">
                        <div class="form-group">
                            <label for="foto_instansi">Foto kantor</label>
                            <input type="file" class="form-control-file" name="gambar_instansi" accept="image/*">
                        </div>
                    </div>
                    <div class="col-6 col-md-6-lg-6">
                        <div class="form-group">
                            <label for="foto_kepala_nagari">Foto kepala Instansi</label>
                            <input type="file" class="form-control-file" name="gambar_kepala">
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-12 col-md-12 mb-2">
                <button class="btn btn-info col-md-12">Submit</button>
            </div>
            </form>
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
            config.sourceAreaTabSize = 8;
            CKEDITOR.replace('editor1', config);
            CKEDITOR.replace('editor2', config);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#add-sosmed').on('click', function() {
                var newInput = `
                <div class="row mb-2">
                    <div class="col-md-3 mb-2">
                        <select class="form-control media-select" name="media[]">
                            <option value="" selected disabled hidden>Pilih Medsos</option>

                            @foreach ($media as $social_media)
                                <option value="{{ $social_media->id }}">
                                    {{ $social_media->nama_sosmed }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-7 mb-2">
                        <input type="text" class="form-control" name="sosmed_url[]" placeholder="Masukkan URL">
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="button" class="btn btn-danger remove-sosmed">Remove</button>
                    </div>
                </div>`;
                $('#sosmed-inputs').append(newInput);
                updateMediaSelects();
            });

            $(document).on('click', '.remove-sosmed', function() {
                $(this).closest('.row').remove();
                updateMediaSelects();
            });

            $(document).on('change', '.media-select', function() {
                updateMediaSelects();
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
                        if (optionValue && selectedValues.includes(optionValue) && optionValue !==
                            currentSelect.val()) {
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
