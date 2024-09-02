@extends('front.layouts.app')
@section('content')
    @include('front.layouts.header_detail')
    <main id="main" class="mt-4 py-4">
        <section class="pengumuman">
            <div class="container mt-4">
                <h2 class="text-center">Download Pengumuman Nagari</h2>

                <div class="row">
                    <div class="card-body">
                        <div class="pengumuman">

                            <div class="table-responsive">
                                <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 1%;">No</th>
                                            <th style="width: 20%;">Pengumuman</th>
                                            <th style="width: 4%;">Tanggal</th>
                                            <th style="width: 6%;">File</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('front.layouts.footer')
    </main>
@endsection
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@push('scripts')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl_list').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                language: {
                    emptyTable: "Tidak ada data"
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'judul_pengumuman',
                        name: 'judul_pengumuman'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            let date = new Date(data);
                            return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-
                                2) + '-' + ('0' + date.getDate()).slice(-2);
                        }
                    },
                    {
                    data: 'file_pengumuman',
                    name: 'file_pengumuman',
                    render: function(data, type, row) {
                        return '<a href="' + data + '" class = "btn btn-primary btn-sm">Download</a>';
                    }
                },
                ]
            });
        });
    </script>
@endpush
