<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="/" class="logo d-flex align-items-center">
            <img src="{{ $app->logo ? asset($app->logo) : '' }}" class="rounded" alt="">

            </a></h1>



        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('beranda') }}" class="nav-link">Beranda</a></li>

                @if ($pengumuman->count() > 0)
                    <li><a class="nav-link" href="{{ route('pengumuman_nagari') }}">Pengumuman</a></li>
                @endif
                @if ($download->count() > 0)
                    <li><a class="nav-link" href="{{ route('download_nagari') }}">Download</a></li>
                @endif
                @foreach ($menu as $key => $data)
                    @if ($data->status == 4)
                        <a href="{{ route('halaman', $data->slug) }}">{{ $data->nama }}</a>
                    @elseif ($data->url)
                        <a href="{{ $data->url }}"><span>{{ $data->nama }}</span></a>
                    @else
                        @if ($grouphalaman->has($data->id))
                            <li class="dropdown">
                                <a href="#"><span>{{ $data->nama }}</span> <i
                                        class="bi bi-chevron-down"></i></a>
                                <ul>
                                    @foreach ($grouphalaman[$data->id] as $item)
                                        <li>
                                            @if ($item->nama)
                                                <a href="{{ route('halaman', $item->slug) }}">{{ $item->nama }}</a>
                                            @elseif ($item->url)
                                                <a href="{{ $item->url }}">{{ $item->nama }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
