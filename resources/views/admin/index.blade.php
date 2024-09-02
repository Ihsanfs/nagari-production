@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="mt-2 mb-4">
    <h2 class="text-center pb-2">Selamat Datang {{ Auth::user()->name }}</h2>

</div>
<div class="row">
    @if(Auth::user()->role_id == 1)
    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ Auth::user()->count() }}</h2>
                <p>Jumlah User</p>

            </div>
        </div>
    </div>
@endif

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ $berita }}</h2>
                <p> Jumlah Berita </p>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ $halaman }}</h2>
                <p> Jumlah Halaman </p>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ $video }}</h2>
                <p> Jumlah Video </p>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ $galery }}</h2>
                <p> Jumlah Album </p>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ $slider }}</h2>
                <p> Jumlah Slider </p>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark bg-info-gradient">
            <div class="card-body pb-0">
                {{-- <div class="h1 fw-bold float-right">+5%</div> --}}
                <h2 class="mb-2">{{ $pengumuman }}</h2>
                <p> Jumlah Pengumuman </p>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">


        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">Daily Sales</div>
                <div class="card-category">March 25 - April 02</div>
            </div>
            <div class="card-body pb-0">
                <div class="mb-4 mt-2">
                    <h1>$4,578.58</h1>
                </div>
                <div class="pull-in">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </div>
        </div>

    </div> --}}
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




