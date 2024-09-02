@extends('front.layouts.app')

<style>
    p {
        text-align: justify !important;
        color: #000000;
    }

    a {
        text-decoration: none;
        color: #000000;
    }

    div#social-links {
        margin: 0 auto;
        max-width: 500px;

    }
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);

    }
    div#social-links ul li {
        display: inline-block;
    }

    div#social-links ul li a {
        padding: 10px;
        border: 1px solid #6d5f5f;
        border-radius: 5px;

        margin: 1px;
        margin-right: 4px;
        font-size: 30px;
        color: #374f72;
        background-color: #fff5f5;
    }

    div#social-links ul li a:hover {
        background-color: #c7c7c7;
        color: #000000;

    }
</style>
@section('content')
    @include('front.layouts.header')
    <main id="main" class="mt-4 py-4">
        <section class="detail_berita">
            <div class="container mt-4">

                <div class="row">
                    {{ Breadcrumbs::render('detail', $slug) }}


                    <div class="col-md-8 mt-2 mb-2">
                        <div class="card border-0">
                            <img class="card-img-top" src="{{ asset($artikel->gambar_artikel) }}" alt="Card image cap">
                            <div class="card-body">
                                <h2>{{ $artikel->judul }}</h2>
                                <p><i class="fa-solid fa-tags"></i>
                                    @foreach ($kat_lop as $item)
                                        <a href="{{ route('kategori_tampil', $item->slug) }}">
                                            <span
                                                class="badge rounded-pill bg-secondary mb-2">{{ $item->nama_kategori }}</span>
                                        </a>
                                    @endforeach
                                </p>
                                <div class="d-flex align-items-center" style="font-size: 15px;">
                                    <p class="mr-3"> <i class="fa-regular fa-calendar-days"></i>
                                        {{ \Carbon\Carbon::parse($artikel->tanggal)->translatedFormat('D, d F Y') }}

                                                  <i class="fa-solid fa-eye"></i> {{ $artikel->views }}
                                    <i class="fa-solid fa-user"></i> {{ $artikel->users->name }}</p>
                                </div>

                                <p>{!! $artikel->body !!}</p>

                            </div>
                            <div class="container mt-4">
                                <p>Share :</p>
                                {!! Share::page(route('detail', ['slug' => $slug]))->facebook()->twitter()->linkedin()->telegram()->whatsapp() !!}
                            </div>


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
                                        <div class="card">
                                        <div class="h-100">
                                            <div class="card-body">
                                                <a href="{{ route('detail', $populer->slug) }}">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-5 h-100 vh-50">
                                                            <div class="p-1">
                                                            <img class="img-top "
                                                                src="{{ asset($populer->gambar_artikel) }}"
                                                                alt="Card image cap"  style="max-width: 100%; height: 100px; object-fit: contain;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p style="font-size: 15px">{!! Str::limit($populer->judul, 50) !!}</p>
                                                            <p style="font-size: 15px">
                                                                <i class="fa-solid fa-calendar-days"></i>
                                                                {{ \Carbon\Carbon::parse($populer->tanggal)->translatedFormat('d F Y') }}

                                                                <i class="fa-solid fa-eye" style="margin-left: 10px;"></i>
                                                                {{ $populer->views }}

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
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
                                    <div class="mb-2 h-100">
                                        <div class="card">
                                        <div class="card-body">

                                            <a href="{{ route('detail', $item->slug) }}">
                                                <div class="row align-items-center">
                                                    <div class="col-md-5">

                                                        <img class="card-img-top" src="{{ asset($item->gambar_artikel) }}"
                                                            alt="Card image cap" style="max-width: 100%; height: 100px; object-fit: contain;">

                                                    </div>
                                                    <div class="col-md-7">
                                                        <p style="font-size: 15px">{!! Str::limit($item->judul, 70) !!}</p>
                                                        <p style="font-size: 15px">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                                                            <i class="fa-solid fa-eye" style="margin-left: 10px;"></i>
                                                            {{ $item->views }}

                                                        </p>

                                                    </div>

                                                </div>

                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <div class="card mt-2 mb-12">
                            <h4 style="background-color: #0055c5" class="text-white p-2">Kategori</h4>
                            <div class="d-flex flex-wrap">
                                @foreach ($kat_lop as $nama_kategori => $items)
                                    <div class="mr-2 p-2 mb-2">
                                        <a href="{{ route('kategori_tampil', $items->slug) }}">
                                            <span class="badge bg-primary">
                                                {{ $items->nama_kategori }}
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card mt-2 mb-12">
                            <h4 style="background-color: #0055c5" class="text-white p-2">Tag</h4>
                            <div class="d-flex flex-wrap">
                                @foreach ($tag_lop as $item)
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
        @include('front.layouts.footer')

    </main>
@endsection
