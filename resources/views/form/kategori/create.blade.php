@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-md-4">

            <form action="{{route($role.'.kategori_store')}}" method="POST">
                @method('POST')
                @csrf

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="nama_kategori"  class="form-control" placeholder="Enter kategori">
            </div>

        </div>
        <div class="col-md-4 p-4">
            <div class="form-group ">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


