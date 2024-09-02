
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover" >
            <a href="{{route($role.'.pengumuman_create')}}" class="btn btn-secondary btn-round">Add pengumuman</a>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengumuman</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody>
                @php
                $no = 1;
                @endphp

                @foreach($pengumuman as $item)


                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->judul_pengumuman}}</td>
                    <td>{{$item->file_pengumuman}}</td>

                    <td>
                        <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">
                            <i class="fa fa-edit"></i> Edit
                        </button>

                        <form action="{{ route($role. '.pengumuman_delete', $item->id) }}" method="POST" style="display: inline;">
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
                                    <form action="{{ route($role . '.pengumuman_update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="judul_pengumuman">Judul</label>
                                            <input type="text" name="judul_pengumuman" class="form-control" placeholder="Enter judul" value="{{ $item->judul_pengumuman }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">file Saat ini</label>
                                               <p>{{$item->file_pengumuman}}</p>
                                        </div>


                                        <input type="file" name="file_pengumuman" class="form-control" accept="image/*,.pdf" multiple>



                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="" {{ $item->is_active == null ? 'selected' : '' }} disabled>Select Status</option>
                                                <option value="1" {{ $item->is_active == '1' ? 'selected' : '' }}>Published</option>
                                                <option value="0" {{ $item->is_active == '0' ? 'selected' : '' }}>Draft</option>
                                            </select>
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
                      @if($pengumuman->count() > 0)
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

