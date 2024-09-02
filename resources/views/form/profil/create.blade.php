@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <h2 class="text-white">Profil Users</h2>
        <div class="row py-4">
                <div class="col-12 col-md-6 mb-2">
                    <form action="{{ route('superadmin.users_store') }}" class="col-md-auto" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control"  name="nama">
                    </div>

                    <div class="form-group">
                        <label for="nama">Password</label>
                        <input type="password" class="form-control"  name="password">
                    </div> <div class="form-group">
                        <label for="nama">Email</label>
                        <input type="email" class="form-control"  name="email">
                    </div>


                </div>

                <div class="col-12 col-md-6 mb-2">

                    <div class="form-group">
                        <label for="foto_instansi">Upload gambar</label>
                        <input type="file" class="form-control-file" name="gambar_user">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="roles" id="" class="form-control">
                            <option value=""  disabled selected>Pilih Role</option>

                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" id="" class="form-control">
                            <option value=""  disabled selected>Pilih Status</option>
                            <option value="1">publish</option>
                            <option value="0">draft</option>

                        </select>

                    </div>
                </div>




                <div class="col-12 col-md-12 mb-2">
                    <button class="btn btn-info col-md-12">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection
