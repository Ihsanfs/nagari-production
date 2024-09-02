
@extends('layouts.dashboard')
@section('content')
@include('alert.alert')
<div class="card-body">
    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover" >
            <a href="{{route($role.'.video_add')}}" class="btn btn-secondary btn-round">Add Video</a>
            <thead>


                <tr>
                    <th>No</th>
                    <th>judul</th>
                    <th>Link Kode Video Youtube</th>
                    <th>Video</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody>
                @php
                $no = 1;
                @endphp

                @foreach($slide as $item)


                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->judul_slide}}</td>

                    <td>
                        @if($item->link == '')
                        <span class="badge bg-warning text-white"> Tidak Ada Link Video</span>
                        @else
                        {{$item->link}}
                        @endif
                       </td>

                    <td>
                        @if (pathinfo($item->video_slide, PATHINFO_EXTENSION) == 'mp4' || pathinfo($item->video_slide, PATHINFO_EXTENSION) == 'webm' || pathinfo($item->video_slide, PATHINFO_EXTENSION) == 'ogg')
                            <video width="150px" controls>
                                <source src="{{ asset($item->video_slide) }}" type="video/{{ pathinfo($item->video_slide, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </td>

                    <td>
                        @if($item->is_active == 1)
                          Published
                        @else
                            Draft
                        @endif

                    </td>
                    <td><a href="{{ route($role.'.video_edit', ['id' => $item->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <form action="{{ route($role.'.video_delete', ['id' => $item->id]) }}" method="post" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus ?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach



            <tr>
                <td colspan="6" class="text-center">
                      @if($slide->count() > 0)
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
