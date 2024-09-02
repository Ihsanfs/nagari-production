@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
    <div class="container">
        <h2 class="text-white">Keamanan Users</h2>
        <div class="col-6 col-md-12 ml-auto text-right">

        </div>

        @if($user)
        <div class="row py-4">

            <div class="col-12 col-md-12 mb-2">
                    <form action="{{ route($role.'.users_password_update', $user->id) }}" class="col-md-auto" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <input type="text" class="form-control text-dark" name="name" value="{{$user->name}}" disabled>
                        <input type="hidden" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Password</label>
                        <input type="password" class="form-control text-dark"  name="password">

                    </div>
                    <div class="py-2 col-12 col-md-12 mb-2 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-info col-md-12 mx-auto">Submit</button>
                    </div>

                </div>


            </form>
        @endif
    </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
