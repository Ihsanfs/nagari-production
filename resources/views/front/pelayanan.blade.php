@extends('front.layouts.app')
@section('content')
    <style>
        p {
            text-align: justify !important;
            color: #000000;
        }

        a {
            text-decoration: none;
            color: #000000;
        }
    </style>
    @include('front.layouts.header_detail')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <main id="main" class="mt-4 py-1">
        <section class="detail p-4 mt-4">
            <div class="card p-2 mt-4 " style="border-radius: 50px;">

                <div class="container mt-4">
                    <div class="row">
                        {{ Breadcrumbs::render('layanan', $slug) }}

                        <div class="col-md-6  mt-2 mb-2">
                            <div class="card h-100 border-0">
                                <div class="card-body">
                                    <div class="p-4">
                                        <img class="card-img-top" src="{{ asset($pelayanan->gambar_layanan) }}"
                                            alt="Card image cap" style="max-width: 100%; height: auto;">
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="col-md-6  mt-2 mb-2">
                            <div class="card h-100 border-0">
                                <div class="card-body">
                                    <div class="p-2">
                                        <div class="card-title ">
                                            <p class="text-center">{{ $pelayanan->nama_pelayanan }}</p>
                                        </div>
                                        @php
                                            $tanggal = \Carbon\Carbon::createFromFormat('Y-m-d', $pelayanan->tanggal);
                                        @endphp

                                        <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ $tanggal->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
                                        <div class="card-body">
                                            <p>{!! $pelayanan->deskripsi !!}</p>
                                        </div>

                                    </div>


                                </div>

                            </div>
                        </div>



                    </div>
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
