@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <h2 class="text-white">Profil Users</h2>

        @if($user)
        <div class="row py-4">
                <div class="col-12 col-md-6 mb-2">
                    <form action="{{ route($role.'.users_update', $user->id) }}" class="col-md-auto" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{$user->name}}" name="nama">
                    </div>

                    @if(Auth::user()->role_id == 1)
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="" {{ $user->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                            <option value="1" {{ $user->is_active == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $user->is_active == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="roles" id="" class="form-control">
                            <option value="" disabled {{ $user->role_id == null ? 'selected' : '' }}>Select Role</option>

                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $user->role_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    @endif
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="gambar">Foto Users</label>
                        <img src="{{asset($user->gambar)}}" style="width: 500px; height:285px;" alt="">
                    </div>
                    <div class="form-group">
                        <label for="foto_instansi">Upload gambar</label>
                        <input type="file" class="form-control-file" name="gambar_user">
                    </div>
                </div>


                <div class="col-12 col-md-12 mb-2">
                    <button class="btn btn-info col-md-12">Submit</button>
                </div>

        </div>
        @endif
    </div>
@endsection
