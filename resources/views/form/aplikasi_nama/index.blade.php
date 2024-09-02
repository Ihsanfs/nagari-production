@extends('layouts.dashboard')
@section('content')

    <div class="card-body">

        @include('alert.alert')
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    @if ($app->count() === 0)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagcreate">
                            Create
                        </button>
                    @endif
                @endif


                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Website</th>
                        <th>Lokasi</th>
                        <th>Logo</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($app as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_web }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td><img src="{{ asset($item->logo) }}" alt="" width="150"></td>


                            <td>


                                <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <form action="{{ route($role . '.apps_delete', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-xs"
                                        onclick="return confirm('apakah anda ingin menghapus ?')">delete</button>
                                </form>
                            </td>
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit nama Apps
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route($role . '.apps_update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="name2">Nama Website</label>
                                                    <input type="text" name="website" class="form-control"
                                                        value="{{ $item->nama_web }}" />
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="name2">Lokasi</label>
                                                    <input type="text" name="lokasi" class="form-control"
                                                        value="{{ $item->lokasi }}" />
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="name2">Logo</label>
                                                    <input type="file" class="form-control" name="logo"
                                                        value="{{ $item->logo }}">
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="name2">logo saat ini </label>
                                                    <img src="{{ asset($item->logo) }}" alt="" width="150">
                                                </div>


                                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="tagcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Website Nama</h5>

                    </div>
                    <div class="modal-body">
                        <div class="modal-body p-4">
                            <form action="{{ route($role . '.apps_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name2">Nama Website</label>
                                    <input type="text" name="website" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name2">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name2">Logo</label>
                                    <input type="file" class="form-control" name="logo">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
