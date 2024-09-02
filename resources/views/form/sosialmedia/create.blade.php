@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <form action="{{ route($role.'.media_store') }}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="">Nama Medsos</label>
                    <input type="text" name="namasosmed" class="form-control" placeholder="Isikan Nama Medsos">
                </div>

                <div class="form-group">
                    <label>Icon Media</label>
                    <input type="text" name="media_icon" class="form-control" placeholder="Enter icon">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


