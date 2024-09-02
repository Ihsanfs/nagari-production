
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="row">

        <div class="col-md-6 col-lg-6">
            <form action="{{ route($role.'.video_update', ['id' => $slide->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="form-group">
                <label>judul</label>
                <input type="text" name="judul_slide" value="{{$slide->judul_slide}}"  class="form-control" >
            </div>

            @if(!empty($slide->link))
            <div class="form-group">
                <label>Link</label>
               <input type="text" name="link" value="{{$slide->link}}" class="form-control"  >
            </div>
            @endif

            @if(!empty($slide->video_slide))
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Video</label>
                    </div>
                    <div class="col-md-4">
                    <video width="150px" controls>
                        <source src="{{ asset($slide->video_slide) }}" type="video/{{ pathinfo($slide->video_slide, PATHINFO_EXTENSION) }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
                </div>

            </div>

            <div class="form-group">
                <label>Video</label>
                <input type="file" name="video_slide" class="form-control"  >
            </div>
            @endif
            <div class="form-group">
                <label>status</label>
                <select name="is_active" class="form-control">
                    <option value="" {{ $slide->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                    <option value="1" {{ $slide->is_active == '1' ? 'selected' : '' }}>publish</option>
                    <option value="0" {{ $slide->is_active == '0' ? 'selected' : '' }}>draft</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
            </div>

    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
