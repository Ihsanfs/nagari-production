
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover" >
            <a href="{{route($role.'.media_create')}}" class="btn btn-secondary btn-round">Add Media</a>
            <thead>


                <tr>
                    <th>No</th>
                    <th>Medsos Nama</th>
                    <th style="width: 30%; text-align: center;">Gambar Media</th>

                    <th>Icon</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody>
                @php
                $no = 1;
                @endphp

                @foreach($media as $item)


                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->nama_sosmed}}</td>
                    <td class="text-center">{!! $item->media_font !!}</td>
                    <td>{{$item->media_font}}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">
                            <i class="fa fa-edit"></i> Edit
                        </button>

                        <form action="{{ route($role. '.media_delete', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-xs"  onclick="return confirm('apakah anda ingin menghapus ?')">delete</button>
                            </form>
                    </td>
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Slider</h5>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route($role . '.media_update', $item->id) }}" method="POST" >
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="">Nama Medsos</label>
                                            <input type="text" name="namasosmed" class="form-control" value="{{ $item->nama_sosmed }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="media_icon">Icon</label>
                                            <input type="text" name="media_icon" class="form-control" placeholder="Enter judul" value="{{ $item->media_font }}">
                                        </div>


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            <tr>
                <td colspan="6" class="text-center">
                      @if($media->count() > 0)
                    @else
                    Data masih kosong
                </td>
            </tr>
            @endif
        </tbody>
        </table>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

