@if(Session::has('success'))
    <script>

        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ Session::get('success') }}',
            timer: 12000,
            timerProgressBar: true,
        });
    </script>
@endif
@if(Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'error',
            text: '{{ Session::get('error') }}',
            timer: 12000,
            timerProgressBar: true,
        });
    </script>

@endif
@if(Session::has('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: '{{ Session::get('warning') }}',
            timer: 12000,
            timerProgressBar: true,
        });
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

