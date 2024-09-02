
@extends('layouts.dashboard')
@section('content')

<div class="card-body">

    @include('alert.alert')
    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover" >
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

            {{-- <a href="{{ route($role . '.kategori_add') }}" class="btn btn-secondary btn-round">Add Kategori</a> --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagcreate">
               Create
              </button>
        @endif


            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tag</th>
                    <th>slug</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tag as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->nama_tag}}</td>
                    <td>{{$item->slug}}</td>
                    <td>

                        {{-- <a href="{{ route($role. '.edit_tag', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> edit</a> --}}
                        <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <form action="{{ route($role. '.tag.delete', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-xs"  onclick="return confirm('apakah anda ingin menghapus ?')">delete</button>
                            </form>
                    </td>
                    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$item->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{$item->id}}">Edit Tag</h5>
                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route($role . '.tag.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name2">Nama Tag</label>
                                            <input type="text" name="nama_tag" class="form-control" value="{{ $item->nama_tag }}" />
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
            </tbody>
        </table>
    </div>


<!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="tagcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tag</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <div class="modal-body p-4">
                <form action="{{route($role . '.tag.store')}}"  method="POST">
                    @csrf
                    @method('post')

                    <div class="form-outline mb-4">
                        <label class="form-label" for="name2">Nama Tag</label>

                        <input type="text" name="nama_tag" class="form-control" />
                    </div>




                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
