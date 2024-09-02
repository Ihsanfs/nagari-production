<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-6 footer-info">
                    <a href="{{route('beranda')}}" class="logo align-items-center mb-4">

                       <h2><strong>{{$app->nama_web}}</strong></h2>
                    </a>

                    <div class="social-links mt-3">
                        <ul>
                            <div class="form-group">
                                @foreach ($media as $item)
                                <a href="{{$item->url}}"> {!! $item->sosmed->media_font !!}</a>
                                @endforeach
                            </div>
                            <li style="list-style-type: none;">
                                <p class="text-white">
                                    <span>Pengunjung Aktif {{$ip}} </span><br>
                                    <span>Pengunjung Hari Ini {{$hariini}} </span><br>
                                    <span>Pengunjung Kemarin {{$kemarin}}</span><br>
                                    <span>Pengunjung Minggu ini {{$mingguan}}</span><br>
                                    <span>Pengunjung Bulanan {{$bulanan}}</span><br>
                                    <span>Total Seluruh Pengunjung {{$totalvisit}}</span>
                                </p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 footer-links">
                    <h4>Lokasi <i class="fa-solid fa-location-dot"></i></h4>
                    <div class="card p-2">
                       {!! $app->lokasi !!}
                    </div>
                </div>


                <span class="text-white">{{ \Carbon\Carbon::now()->year }} <i class="fa-regular fa-copyright"></i> Diskominfo Pasaman Barat</span>
            </div>
        </div>
    </div>

</footer>
