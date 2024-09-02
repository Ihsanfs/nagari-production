@extends('front.layouts.app')
@section('content')
    <style>
        .btn-detail {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 5px 10px;

        }

        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        }

        .custom-pagination {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .custom-pagination .swiper-pagination-bullet {
            width: 20px;
            height: 20px;
            background-color: #fbff00;
            margin: 0 5px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-pagination .swiper-pagination-bullet-active {
            background-color: #27da62e6;
        }

        video {
            max-width: 100%;
            height: auto;
        }

        #g_gallery {
            transition: transform .2s;
        }

        #g_gallery:hover {
            -ms-transform: scale(1.5);

            -webkit-transform: scale(1.5);

            transform: scale(1.5);
        }

        a,
        button {
            cursor: pointer;
            user-select: none;
            border: none;
            outline: none;
            background: none;
        }

        #g_gal {
            width: 100%;
            height: 400px;
            position: relative;
            overflow: hidden;
        }

        #g_gal img {

            object-fit: cover;
            width: calc(100% - 20px);

            height: calc(100% - 70px);

            position: absolute;
            top: 70px;

            left: 8px;

            right: 12px;

        }

        .section {
            margin: 0 auto;
            padding-block: 5rem;
        }

        .container {
            max-width: 75rem;
            height: auto;
            margin-inline: auto;
            padding-inline: 1.25rem;
        }

        .gambar-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }


        .image-container {
            width: 100%;
            height: 0;
            padding-top: 60%;
            position: relative;
            overflow: hidden;
        }

        .swiper-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .autoplay-progress svg {
            --progress: 0;
            position: absolute;
            left: 0;
            top: 0px;
            z-index: 10;
            width: 100%;
            height: 100%;
            stroke-width: 4px;
            stroke: var(--swiper-theme-color);
            fill: none;
            stroke-dashoffset: calc(125.6px * (1 - var(--progress)));
            stroke-dasharray: 125.6;
            transform: rotate(-90deg);
        }

        #berita-utama {

            background-color: #2c4766;
            background-size: cover;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @include('front.layouts.header')
    <main id="main">
        <section id="hero">
            <div id="heroCarousel" data-bs-interval="1000" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
                <div class="carousel-inner" role="listbox">
                    @foreach ($slidertampil as $key => $item)
                        <div class="carousel-item @if ($key == 0) active @endif"
                            style="background-image: url('{{ asset($item->gambar_slider) }}'); background-size: cover; background-repeat: no-repeat;   background-position: center;  background-attachment: fixed;">
                            <div class="carousel-container">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-8 d-flex flex-column justify-content-center ">

                                        <h2 class="p-4 mb-4 text-center" style="margin-bottom: 25px;">Selamat Datang di
                                            <span>{{$app->nama_web}}</span></h2>

                                    </div>
                                    <div class="col-md-4 d-flex flex-column justify-content-center" data-aos="zoom-out"
                                        data-aos-delay="200">
                                        <div class="card" style="background: none; border: none;">

                                            @if ($instansi && $instansi->foto_kepala && $instansi->nama)
                                                <img src="{{ asset($instansi->foto_kepala) }}" style="z-index: 99;"
                                                    class="img-fluid" alt="">
                                                <div class="card p-1">
                                                    <span class="text-center"
                                                        style="font-size: 25px">{{ $instansi->nama }}</span>
                                                </div>
                                            @else
                                                <img src="{{ asset('images/walinagari.png') }}" style="z-index: 99;"
                                                    class="img-fluid rounded" alt="">
                                                <div class="card p-1">
                                                    <span class="text-center"
                                                        style="font-size: 25px">{{ $instansi->nama ?? '-' }}</span>
                                                </div>
                                            @endif




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



        @if ($instansi)
            <section id="sambutan">
                <div class="div">
                    <div class="container">
                        <h2 class="text-center" class="text-white"><strong>Sambutan Wali Nagari</strong></h2>
                        <hr>
                        <h5 style=" text-align: justify;
                        text-justify: inter-word;">
                            {!! $instansi->sambutan !!}</h5>
                    </div>
                </div>
            </section>

            <section id="instansi" style="background-color: #2c4766">

                <div class="container">

                    <div class="row">
                        <div class="col-md-6 text-center justify-content-center">
                            <h1 class="text-white"><strong>Kantor</strong></h1>
                            <div class="card p-2 border-0 ">
                                <img src="{{ asset($instansi->foto_instansi) }}"
                                    style="height: 500px; width:100%; margin-left: auto;
                            margin-right: auto;"
                                    class="img-fluid rounded" alt="">
                            </div>
                        </div>

                        <div class="col-md-6 justify-content-center  ">

                            <h1 class=" text-center text-white"> <strong>Profil Nagari</strong></h1>

                            <div class="card p-2" style="border: none">
                                <p class="text-justify">  {!! $instansi->deskripsi_profil ? $instansi->deskripsi_profil : "deskripsi kosong" !!}

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section id="informasi">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="container">
                            <h2 style="color: #087536"><i class="fa-solid fa-image"></i> <strong> Gambar
                                    Nagari</strong></h2>
                            <swiper-container class="mySwiper p-2" pagination="true" pagination-clickable="true"
                                space-between="30" centered-slides="true" autoplay-delay="2500"
                                autoplay-disable-on-interaction="false">
                                @foreach ($slidertampil as $key => $item)
                                    <swiper-slide>

                                        <div class="swiper-slide">
                                            <div class="image-container">
                                                <img src="{{ asset($item->gambar_slider) }}" alt="Swiper"
                                                    class="swiper-image rounded">
                                            </div>
                                            <div class="mt-2">
                                            </div>
                                        </div>

                                    </swiper-slide>
                                @endforeach

                                <div class="autoplay-progress" slot="container-end">
                                    <svg viewBox="0 0 48 48">
                                        <circle cx="24" cy="24" r="20"></circle>
                                    </svg>
                                    <span></span>
                                </div>
                            </swiper-container>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="container">
                            <h2 class="text-dark p-2"><i class="fa fa-bullhorn" aria-hidden="true"></i> <strong>Daftar
                                    Informasi</strong></h2>


                            <div class="row">
                                @foreach ($pelayanan as $item)
                                    <div class="col-4 col-md-4 p-2 align-center justify-content-center text-center">

                                        <a href="{{ route('layanan', $item->slug) }}">
                                            <img src="{{ $item->gambar_layanan }}"
                                                style="max-width: 100%; max-height: auto;" class="rounded" alt=""
                                                class="img-fluid">
                                        </a>
                                        <p>{{ $item->nama_pelayanan }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        @if (count($berita_terbaru) > 0)
            <section id="berita-utama">

                <div class="container" data-aos="fade-up">

                    <div class="container" data-aos="fade-up">
                        <h1 class=" text-left"><strong class="text-white"><i class="fas fa-newspaper"></i> Berita
                                Utama</strong> </h1>
                        <hr>
                        <div class="row">
                            @foreach ($berita_terbaru as $key => $item)
                                <div class="col-12 mb-2 col-md-4 d-flex align-items-stretch ">
                                    <div class="card vh-50">
                                        <div class="card-body d-flex flex-column">
                                            <div class="gambar-container">
                                                <img src="{{ asset($item->gambar_artikel) }}" class="img-fluid"
                                                    alt="">
                                            </div>
                                            <span class="p-2" style="font-size: 15px; color:#b9b9b9;">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                                                <i class="fa-solid fa-eye"></i> {{ $item->views }}
                                                <i class="fa-solid fa-user"></i> {{ $item->users->name }}
                                            </span>
                                            <h6 class="text-dark">{{ $item->judul }}</h6>
                                            <a href="{{ route('detail', $item->slug) }}"
                                                class="readmore stretched-link mt-auto">
                                                <span>Selengkapnya</span><i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center">
                            <a class="btn btn-primary col-md-8" href="{{ route('berita_lengkap') }}">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>


                </div>

            </section>
        @endif
        <div class="p-4" style="background-color: #EEEEEE">
            <div class="container">
                <div class="row">
                    @if (count($galeri) > 0)
                        <div class="col-md-7">
                            <h4 class="card-title p-2 bg-primary text-white rounded"><i class="fa-solid fa-image"></i>
                                Galeri</h4>
                        @else
                            <div class="col-md-12">
                    @endif

                    <div class="card p-2 border-0 mb-2 mt-2">
                        <div class="row">
                            @foreach ($galeri as $item)
                            @if(count($galeri) == 1)
                                <div class="col-md-12 mb-3">
                            @else
                                <div class="col-md-6 mb-3">
                            @endif
                                <div class="card h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-text">{{ $item->nama_album }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('album_tampil', $item->slug) }}">
                                            <img src="{{ asset($item->album_image) }}" class="img-fluid" alt="" style="width: 100%" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        </div>

                    </div>
                    @if (count($video) > 0)
                        <h4 class="card-title p-2 bg-primary text-white rounded"><i class="fa-solid fa-image"></i>
                            Video</h4>
                        <div class="row">
                            @foreach ($video as $item)
                                <div class="col-lg-6 col-md-4 mb-4 mt-4">
                                    <div class="card h-100 p-2">
                                        <div class="card-header" style="background-color: rgb(13, 100, 253)">
                                            <h4 class="card-text text-white">{{ $item->judul_slide }}</h4>
                                        </div>
                                        <div class="card-body">
                                            @if($item->link != '')
                                            <object data="https://www.youtube.com/embed/{{$item->link}}" width="100%" ></object>
                                            @else
                                            <video width="400" controls>
                                                <source src="{{ asset($item->video_slide) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if (count($galeri) > 0)
                    <div class="col-md-5">
                    @else
                        <div class="col-md-12">
                @endif
                @if (count($berita_populer) > 0)
                    <h4 class="card-title p-2 bg-primary text-white rounded"><i class="fas fa-newspaper"></i> Berita
                        Populer</h4>
                    <div class="card mb-2 mt-2">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($berita_populer as $key => $item)
                                    <div class="col-md-6">
                                        <div class="mb-3">

                                                <a href="{{ route('detail', $item->slug) }}" class="text-decoration-none text-dark">
                                                    <div class="card">
                                                    @if ($item->gambar_artikel)
                                                        <img src="{{ asset($item->gambar_artikel) }}" alt="Image" class="rounded img-fluid w-100" style="height: 100px; ">
                                                    @else
                                                        <img src="{{ asset('images/noimage.png') }}" alt="No Image" class="rounded img-fluid w-100" style="height: 100px; ">
                                                    @endif
                                                    <p style="font-size: 20px;" class="p-2">{{ Str::limit($item->judul, 50) }}</p>
                                                    <p class="p-2 text-center" style="color: #b9b9b9">
                                                        <i class="fa-regular fa-calendar-days"></i>
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                                                        <span><i class="fa-solid fa-eye"></i> {{ $item->views }}</span>
                                                    </p>
                                                </div>
                                                </a>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>
        </div>

    </main>
    @include('front.layouts.footer')
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");

        const swiperEl = document.querySelector("swiper-container");
        swiperEl.addEventListener("autoplaytimeleft", (e) => {
            const [swiper, time, progress] = e.detail;
            progressCircle.style.setProperty("--progress", 1 - progress);
            progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        });
    </script>
@endpush
