@extends('layouts.dashboard')
@section('content')


    <div class="card-body">

        @include('alert.alert')
        <div class="container">
            <div class="row">
                <div class="col-md-2 mt-2 mb-2">
                    <a href="{{ route($role . '.galery_create') }}" class="btn btn-secondary btn-round">TambahGallery</a>
                </div>
                <div class="col-md-2 mt-2 mb-2">
                    <a href="{{ route($role . '.album_create') }}" class="btn btn-danger btn-round">Tambah Album</a>

                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">


                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Album</th>
                        <th>Thumbnails</th>
                        <th>jumlah galery</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                <tbody>
                    @foreach ($gallery as $key => $item)
                        <tr>

                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_album }}</td>
                            <td>

                                    <img src="{{ asset($item->album_image) }}" width="200" height="150"
                                        alt="" />

                            </td>
                            <td>
                                {{ $foto->where('id_album', $item->id)->count() }} Foto
                            </td>

                            {{-- <div class="modal fade" id="modalalbum" tabindex="-1" role="dialog"
                                aria-labelledby="modalalbumLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalalbumLabel">Gallery</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div id="galeri" class="row"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <td>
                                @if ($item->is_active == 1)
                                    Published
                                @else
                                    Draft
                                @endif

                            </td>
                            <td><a href="{{ route($role . '.album_edit', ['id' => $item->id]) }}"
                                    class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route($role . '.album_isi', ['id' => $item->id]) }}"
                                        class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Lihat Gallery</a>
                                <form action="{{ route($role . '.album_delete', ['id' => $item->id]) }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm "
                                        onclick="return confirm('apakah anda ingin menghapus ?')">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </div>

    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

{{-- <script>
    $(document).ready(function() {
        $('.album-link').on('click', function(e) {
            e.preventDefault();

            var albumId = $(this).data('album-id');

            $.ajax({
                url: "{{ route($role . '.album_isi', '') }}/" + albumId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    var galeri = $('#galeri');
                    galeri.empty();

                    if (response.length === 0) {
                        galeri.append(
                            '<div class="col-md-12 text-center">No images found</div>');
                    } else {
                        $.each(response, function(index, image) {
                            var imageUrl =
                                `{{ asset('') }}${image.gambar_galery}`;
                            var editUrl =
                                `{{ route($role . '.galery_edit', ['id' => ':id']) }}`;
                            editUrl = editUrl.replace(':id', image.id);

                            var deleteUrl =
                                `{{ route($role . '.galery_destroy', ['id' => ':id']) }}`;
                            deleteUrl = deleteUrl.replace(':id', image.id);
                            galeri.append(`

                                <div class="col-md-6 mb-2 mt-2 p-2">
                                    <div class = "card p-2">
                                        ${image.is_active == 0 ? '<p class = "text-center text-white bg-dark">Draft</p>' : ''}
                                    <a data-fancybox="${image.id_album}" href="${imageUrl}" data-caption="${image.nama}" data-sizes="(max-width: 600px) 480px, 800px">
                                        <img src="${imageUrl}" class="img-fluid" style="object-fit: cover;, position: absolute;
                                        top: 0;
                                        left: 0;  width: 300px;
                                        height: 160px;
                                        overflow: hidden;"  alt="" />
                                    </a>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <a href="${editUrl}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        </div>
                                        <div>
                                            <form action="${deleteUrl}" method="post" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus ?')"><i class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                        });

                        Fancybox.bind('[data-fancybox]', {});
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        });
    });
</script> --}}
@endpush
