@extends('front.layouts.app')
@section('content')
    <style>
        p {
        text-align: justify !important;
        color: #000000;
    }

    a{
        text-decoration: none;
        color: #000000;
    }

    .container img {
    max-width: 100% !important;
    height: auto !important;
}
    </style>
    @include('front.layouts.header_detail')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <main id="main" class="mt-4 py-4">
        <section class="detail">
            <div class="container mt-4">
                <div class="row">
                    {{ Breadcrumbs::render('halaman', $slug) }}

                <div class="col-md-8  mt-2 mb-2">
                        <div class="card h-100 border-0">
                            <div class="card-body">

                                <div class="p-4">
                                    @if ($halaman_detail->judul)
                                        <h2>{{ $halaman_detail->judul }}</h2>
                                        <hr style="border: 1px solid red;">
                                    @endif
                                    @if ($halaman_detail->nama)
                                        <h2>{{ $halaman_detail->nama }}</h2>
                                        <hr style="border: 1px solid red;">
                                    @endif
                                    @if ($halaman_detail->gambar_h || $halaman_detail->gambar_page)
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-8">
                                                @if ($halaman_detail->gambar_h)
                                                    <a data-fancybox="gallery"
                                                        data-src="{{ asset($halaman_detail->gambar_h) }}">
                                                        <img src="{{ asset($halaman_detail->gambar_h) }}"
                                                            class="card-img-top" alt="">
                                                    </a>
                                                @elseif($halaman_detail->gambar_page)
                                                    <a data-fancybox="gallery"
                                                        data-src="{{ asset($halaman_detail->gambar_page) }}">
                                                        <img src="{{ asset($halaman_detail->gambar_page) }}"
                                                            class="card-img-top" alt="">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif



                                    @if ($halaman_detail->deskripsi)
                                        <p>{!! $halaman_detail->deskripsi !!}</p>
                                    @endif

                                    @if ($halaman_detail->deskripsi_page)
                                        <p>{!! $halaman_detail->deskripsi_page !!}</p>
                                    @endif
                                </div>


                            </div>

                        </div>
                    </div>
                    @if(!empty($berita_populer))
                    <div class="col-md-4 mt-2 mb-2" data-aos="fade-up" data-aos-delay="200">
                        <form action="{{ route('search_berita') }}" method="GET">
                            <div class="row mt-2">

                                <div class="input-group w-100">
                                    <input class="form-control border-end-0 border" type="text" name="cari_berita"
                                        placeholder="Search" autocomplete="off">
                                    <span class="input-group-append">
                                        <button
                                            class="btn btn-outline-secondary bg-dark border-start-0 border-bottom-0 border ms-n5"
                                            type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>

                            </div>
                        </form>
                        <div class="card mt-2 ">

                            <h3 class="p-2 text-white" style="background-color: #0055c5">Berita Populer</h3>
                            @foreach ($berita_populer as $berita => $populer)
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <div class=" h-100">
                                            <div class="card-body">
                                                <a href="{{ route('detail', $populer->slug) }}">
                                                    <div class="card">
                                                <div class="row align-items-center">

                                                    <div class="col-md-5">
                                                        <div class="p-1">
                                                            <img class="card-img-top"
                                                                src="{{ asset($populer->gambar_artikel) }}"
                                                                alt="Card image cap" style="max-width: 100%; height: 100px; object-fit: contain;">
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
                                        <div class="card-body">
                                            <a href="{{ route('detail', $item->slug) }}">
                                                <div class="card">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">

                                                        <div class="p-1">
                                                        <img class="card-img-top" src="{{ asset($item->gambar_artikel) }}"
                                                            alt="Card image cap" style="max-width: 100%; height: 100px; object-fit: contain;">
                                                        </div>


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
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </section>
    </main>
    @include('front.layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox]', {

        });
    </script>
@endsection
