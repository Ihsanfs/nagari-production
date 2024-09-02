@extends('layouts.dashboard')
@section('content')
    <style>
        .wrap {
            position: absolute;
            bottom: 0;
            top: 22px;
            left: 600px;


        }

        #searchcard {
            display: none;
            top: 24px;
        }

        @media (max-width: 767px) {
            .wrap {
                position: static;
                top: auto;
                left: auto;
            }

            #searchcard {
                display: none;
                /* Hide on small screens initially */
            }
        }
    </style>
    <div class="card-body">

        @include('alert.alert')
        <div class="col-12 ">
            <div class="ml-auto" id="search-nav">
                <div class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Search ..." name="search" id="cari_berita" autocomplete="off"
                            class="form-control text-dark">
                    </div>
                </div>

                <!-- Keep the search results visible on mobile -->
                <div class="wrap">
                    <div class="card" id="searchcard">
                        <div class="card-body" id="searchResults">
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <a href="{{ route($role . '.berita_add') }}" class="btn btn-secondary btn-round mt-2">Add Berita</a>

    </div>

    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Slug</th>
                    <th>Isi</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Status</th>

                    <th>action</th>
                </tr>
            </thead>

            <tbody>


                @forelse($berita as $key=> $item)
                    <tr>
                        <td>{{ $berita->firstItem() + $key }}</td>
                        <td>{{ Illuminate\Support\Str::limit($item->judul, 15) }}</td>
                        <td>{{ Illuminate\Support\Str::limit($item->slug, 15) }}</td>
                        <td>{!! Illuminate\Support\Str::limit($item->body, 50) !!}</td>

                        <td>
                            @if (isset($item->kategori))
                                {{ $item->kategori->nama_kategori }}
                            @else
                                Kategori tidak ada
                            @endif
                        </td>
                        <td>
                            <img src="{{ asset($item->gambar_artikel) }}" style="height:60px"
                                class="rounded img-thumbnail mb-2 mt-2" alt="gambar artikel">
                        </td>

                        <td>
                            @if ($item->is_active == 1)
                                Publish
                            @else
                                Draft
                            @endif
                        </td>
                        <td>

                            <a href="{{ route($role . '.berita_edit', ['id' => $item->id]) }}"
                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <form action="{{ route($role . '.berita_delete', ['id' => $item->id]) }}" method="post"
                                style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('apakah anda ingin menghapus ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            Data masih kosong
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {!! $berita->render() !!}
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#cari_berita').on('input', function() {
            var searchText = $(this).val();


            if (searchText.length > 0) {

                $.ajax({
                    url: '{{ route($role . '.berita_search') }}',
                    method: 'GET',
                    data: {
                        search: searchText
                    },
                    success: function(response) {
                        $('#searchcard').show();
                        displaySearchResults(response);
                    }
                });
            } else {
                $('#searchcard').hide();
                $('#searchResults').html('');
            }
        });

        function displaySearchResults(data) {

            var resultsContainer = $('#searchResults');
            resultsContainer.html('');

            var card = '#searchcard';

            if (data.length === 0) {

                resultsContainer.append('<p>No data found</p>');
            } else {
                $.each(data, function(index, item) {

                    var resultItem = $('<li>')
                        .css('list-style-type', 'none')
                        .append(
                            $('<a>')
                            .attr('href', '/' + '{{ $role }}' + '/berita/search/' + item.slug)
                            .css('color', 'black')
                            .css('text-decoration', 'none')
                            .hover(
                                function() {
                                    $(this).css({
                                        'color': 'white',
                                        'background-color': '#27BDAD'
                                    });
                                },
                                function() {
                                    $(this).css({
                                        'color': 'black',
                                        'background-color': 'transparent'
                                    });
                                }
                            )
                            .text(item.judul)
                        );

                    $('#searchResults').append(resultItem);
                });
            }
        }
    });
</script>
