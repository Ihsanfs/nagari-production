@extends('layouts.dashboard')
@section('content')
        @include('alert.alert')
        <h2 class="text-white">Profil Users</h2>
        <div class="col-6 col-md-12 ml-auto text-right">

            @if($role == 'superadmin')
                <a href="{{ route($role.'.users_edit', $user->id) }}" class="btn btn-warning">Edit Profil</a>


            @else
            <a href="{{ route($role.'.users_edit', $user->id) }}" class="btn btn-warning">Edit Profil</a>
            @endif
        </div>




        @if($user)
        <div class="row py-4">

                <div class="col-12 col-md-6 mb-2">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{$user->name}}" style="color: black"  name="nama" disabled>
                    </div>

                </div>
                <div class="col-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="gambar">Foto Users</label>
                        <img src="{{asset($user->gambar)}}" style="width: 500px; height:285px;" alt="">
                    </div>
                </div>
        @endif

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
