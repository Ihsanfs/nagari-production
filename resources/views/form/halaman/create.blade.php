@extends('layouts.dashboard')
@section('content')

<style>
    #deskripsi,
#g_hal,
#url,
#urut,
#status, #halamanmenu{
    display: none;
}

</style>
    @include('alert.alert')

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <form action="{{ route($role . '.halaman_store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="col-md-12">
                        <h2>Buat Halaman</h2>
                        <hr>
                    </div>

                    <div class="form-group">
                        <label for="nama_halaman">Judul Menu</label>
                        <input type="text" name="judul_halaman" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_halaman">Pilih Menu</label>
                        <select name="nama_h" id="pilihhalaman" class="form-control">
                            <option value="" selected disabled>Pilih jenis menu</option>
                            @foreach ($menu as $item)
                            <option value="{{ $item->id }}">
                                @if($item->status == 1)
                                <span class="badge badge-success">(internal)</span>
                                @endif
                                @if($item->status == 3)
                                <span class="badge badge-success">(internal/eksternal)</span>
                                @endif
                                {{ $item->nama }}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="halamanmenu">
                        <label for="">Pilih halaman menu</label>
                        <select name="halamanamenu" class="form-control" >
                            <option value="" selected disabled>Pilih jenis halaman</option>

                            <option value="1">internal</option>
                            <option value="2">eksternal</option>
                        </select>
                    </div>
                    <div class="form-group" id="deskripsi">
                        <label for="deskripsi_h">Deskripsi</label>
                        <textarea name="deskripsi_h" class="form-control" id="editor1" rows="5" placeholder="deskripsi"></textarea>
                    </div>

                    <div class="form-group" id="g_hal">
                        <label for="g_halaman">Gambar</label>
                        <input type="file" class="form-control-file" name="g_halaman" id="g_halaman">
                    </div>
                    <div class="form-group" id="url">
                        <label for="menu-url">URL</label>
                        <input type="text" name="url" class="form-control">
                    </div>
                    <div class="form-group" id="urut">
                        <label for="urut">Urutan halaman</label>
                        <input type="number" name="urutan" class="form-control" required>
                    </div>


                    <div class="form-group" id="status">
                        <label>Status</label>
                        <select name="is_active" id="" class="form-control"  required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="1">publish</option>
                            <option value="0">draft</option>
                        </select>

                    </div>
                    <div class="form-group p-2 col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm col-md-3 ">Submit</button>

                    </div>
                </form>


            </div>

        </div>

    </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')
<script src="https://fastly.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>

    $(document).ready(function() {
        var config = {
        sourceAreaTabSize: 8,
        versionCheck: false
    };
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
<script>
    $(document).ready(function() {

        $('#halamanmenu, #deskripsi, #g_hal, #url, #urut, #status').hide();


        $('#pilihhalaman').change(function() {
            var selectedValue = $(this).val();

            if (selectedValue) {
                var url = "{{ route($role . '.halaman_cek', ['id' => ':id']) }}";
                url = url.replace(':id', selectedValue);


                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        var status = response.status;
                        if (status == 1) {
                            $('#url').hide();
                            $('#deskripsi, #g_hal, #status, #urut').show();
                            $('#halamanmenu').hide();
                        } else if (status == 3) {

                            $('#halamanmenu').show();
                            $('#deskripsi, #g_hal, #url, #urut, #status').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            } else {

                $('#deskripsi, #g_hal, #url, #urut, #status, #halamanmenu').hide();
            }
        });


        $('select[name="halamanamenu"]').change(function() {
            var halamanMenuValue = $(this).val();
            if (halamanMenuValue == "1") {
                $('#url').hide();
                $('#deskripsi, #g_hal, #status, #urut').show();
            } else if (halamanMenuValue == "2") {
                $('#url').show();
                $('#deskripsi').hide();
                $('#g_hal').hide();
                $('#status, #urut').show();
            }
        });
    });
</script>






