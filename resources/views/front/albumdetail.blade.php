@extends('front.layouts.app')
@section('content')
    @include('front.layouts.header_detail')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <main id="main" class="mt-4 py-4">
        <section class="detail">
            <div class="container mt-4">
                <div class="p-2 bg-light" style="border-radius:20px;">

                    <h4>{{$nama_album}}</h4>
                </div>
                <div class="row">
                    @foreach ($gambar as $key => $galeri)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 p-4 border-0">
                                <div class="card-header" style="background-color: rgb(20, 67, 153)">
                                    <h5 class="card-title mb-2 text-white">{{ $galeri->nama }}</h5>
                                </div>
                                <div class="card-body">
                                    <a data-fancybox="gallery" data-caption="{{ $galeri->nama }}"
                                        data-src="{{ asset($galeri->gambar_galery) }}">
                                        <img src="{{ asset($galeri->gambar_galery) }}" class="card-img-top"
                                            alt="{{ $galeri->nama }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($gambar->isEmpty())
                        <div class="col-md-12">
                            <div class="alert text-white text-center" style="background-color: rgb(20, 67, 153)"  role="alert">
                                Tidak ada gambar yang tersedia.
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
