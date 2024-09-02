@extends('front.layouts.app')

<style>
    /* Mengubah warna teks dan latar belakang tombol navigasi */
    .custom-pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .custom-pagination .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);

    }
    .custom-pagination .pagination li {
        margin-right: 5px;
    }

    p {
        text-align: justify !important;
    }

    .custom-pagination .pagination a,
    .custom-pagination .pagination span {
        padding: 8px 16px;
        text-decoration: none;
        color: #333;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .custom-pagination .pagination a:hover {
        background-color: #043175;
        color: white;
    }

    .custom-pagination .pagination .pagination-current {
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
    }

    .custom-pagination .pagination-prev,
    .custom-pagination .pagination-next {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: background-color 0.3s ease;
        color: #333;
    }

    .custom-pagination .pagination-prev:hover,
    .custom-pagination .pagination-next:hover {
        background-color: #043175;
    }

    .image-container {
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease;
        width: 100%;
    height: 200px;
    overflow: hidden;
    }

    .image-container:hover img {
        transform: scale(1.1);
    }


.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

</style>
@section('content')
    @include('front.layouts.header')

    <main id="main" class="mt-4 py-4">
        <section class="search-berita mt-4">
            <div class="container mt-4">
                {{ Breadcrumbs::render('kategori', $category) }}


                {{-- @foreach ($kategori->pluck('nama_kategori') as $nama_kategori)
                <h4>kategori : {{$nama_kategori}}</h4>
            @endforeach --}}
                {{-- <div class="div">
                    <h2> kategori : {{ $category }}</h2>

                </div> --}}

                </header>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">


                            @foreach ($kategori as $key => $item)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <a href="{{ route('detail', $item->slugartikel) }}"
                                            style="text-decoration: none; color:#333;">
                                            <div class="image-container">
                                                <img class="card-img-top" src="{{ asset($item->gambar_artikel) }}"
                                                  style="  object-fit: cover;"   >
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    <i class="fa-solid fa-tag"></i>
                                                    @if (isset($groupKatLop[$item->id]))
                                                        @foreach ($groupKatLop[$item->id] as $nama_kategori)
                                                            @php $kategori_slug = $categories[$nama_kategori] ?? ''; @endphp
                                                            <a href="{{ route('kategori_tampil', $kategori_slug) }}">
                                                                <span
                                                                    class="badge rounded-pill bg-secondary mb-2">{{ $nama_kategori }}</span>
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </span>
                                                <h5 class="card-title">{{ mb_substr($item->judul, 0, 100) }}</h5>
                                                <p style="font-size: 15px">
                                                    <i class="fa-solid fa-user"></i> {{ $item->name }}
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                    {{ $item->created_at->format('d M Y') }}
                                                    <span><i class="fa-solid fa-eye"></i> {{ $item->views }}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="custom-pagination">
                            {!! $berita->onEachSide(2)->links() !!}
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 mb-2" data-aos="fade-up" data-aos-delay="200">
                        <form action="{{ route('search_berita') }}" method="GET" class="mt-2">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="cari_berita" placeholder="Search" autocomplete="off">
                                        <button class="btn btn-dark" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>




                        <div class="card mt-2 ">

                            <h3 class="p-2 text-white" style="background-color: #0055c5">Berita Populer</h3>


                            @foreach ($berita_populer as $berita => $populer)
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <div class="mb-1  h-100">
                                            <div class="card">                                            <div class="card-body">
                                                <div class="row align-items-center">

                                                    <div class="col-md-5">
                                                        <a href="{{ route('detail', $populer->slug) }}">
                                                            <img class="card-img-top"
                                                                src="{{ asset($populer->gambar_artikel) }}"
                                                                alt="Card image cap" style="max-width: 100%; height: 100px; object-fit: contain;">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p style="font-size: 15px">{!! Str::limit($populer->judul, 50) !!}</p>
                                                        <p style="font-size: 15px">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                            {{ $populer->created_at->format('d M Y') }}
                                                            <i class="fa-solid fa-eye" style="margin-left: 10px;"></i>
                                                            {{ $populer->views }}

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card mt-2 ">
                            <h3 class="text-white p-2" style="background-color: #0055c5">Berita Terbaru</h3>
                            @foreach ($berita_baru as $item)
                                <div class="col-md-12">
                                    <div class="mt-2 mb-2 h-100">
                                        <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <a href="{{ route('detail', $item->slug) }}">
                                                        <img class="card-img-top" src="{{ asset($item->gambar_artikel) }}"
                                                            alt="Card image cap" style="max-width: 100%; height: 100px; object-fit: contain;">
                                                    </a>
                                                </div>
                                                <div class="col-md-7">
                                                    <p style="font-size: 15px">{!! Str::limit($item->judul, 70) !!}</p>
                                                    <p style="font-size: 15px">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        {{ $item->created_at->format('d M Y') }}
                                                        <i class="fa-solid fa-eye" style="margin-left: 10px;"></i>
                                                        {{ $item->views }}

                                                    </p>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="card mt-2 mb-12">
                            <h4  style="background-color: #0055c5" class="text-white p-2">Kategori</h4>
                            <div class="d-flex flex-wrap">
                                @foreach ($kategori_data as $nama_kategori => $items)
                                    <div class="mr-2 p-2 mb-2">
                                        <a href="{{ route('kategori_tampil', $items->slug) }}">
                                            <span class="badge  bg-primary">
                                                {{ $items->nama_kategori }}
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card mt-2 mb-12 ">
                            <h4  style="background-color: #0055c5" class="text-white p-2" >Tag</h4>
                            <div class="d-flex flex-wrap">
                                @foreach ($tag_cek as $item)
                                    <div class="mr-2 p-2 mb-2">
                                        <a href="{{ route('tag_tampil', $item->slug) }}">
                                            <span class="badge bg-success">{{ $item->nama_tag }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
