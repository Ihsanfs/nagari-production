@extends('layouts.dashboard')
@section('content')
    @include('alert.alert')
    <style>
        #link, #video_slide, #status{
    display: none;
}

    </style>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <form action="{{route($role.'.video_store')}}" method="POST" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <label>judul</label>
                        <input type="text" name="judul_slide" class="form-control" placeholder="Masukan judul">
                    </div>

                    <div class="form-group">
                        <select name="linkvideo" id="linkvideo" class="form-control">
                            <option value="">Pilih Jenis Video</option>
                            <option value="1">Link</option>
                            <option value="2">Video</option>
                        </select>
                    </div>
                    <div class="form-group" id="link">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" placeholder="Masukan Link">
                    </div>

                    <div class="form-group" id="video_slide">
                        <label>Video</label>
                        <input type="file" name="video_slide" class="form-control">
                    </div>

                    <div class="form-group" id="status">
                        <label>status</label>
                        <select name="is_active" class="form-control">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="1">publish</option>
                            <option value="0">draft</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Send message</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function () {
    let value1 = $('#linkvideo');
    let status = $('#status');
    let link = $('#link');
    let video = $('#video_slide');

    // Sembunyikan elemen saat halaman dimuat
    link.hide();
    status.hide();
    video.hide();

    value1.change(function (e) {
        if ($(this).val() == 1) {
            link.show();
            status.show();
            video.hide();
        } else if ($(this).val() == 2) {
            link.hide();
            status.show();
            video.show();
        } else {
            link.hide();
            status.hide();
            video.hide();
        }
    });
});

</script>
