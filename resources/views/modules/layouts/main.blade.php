<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        TPA Pesayidan - @stack('modules-title')
    </title>

    @include('modules.layouts.components.css.css')

    @stack('modules-css')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <div id="wrapper">

        @if (Auth::user()->akses == "ADMIN")
            @include('modules.layouts.components.sidebar.sidebar')
        @elseif(Auth::user()->akses == "GURU")
            @include("modules.layouts.components.sidebar.sidebar-guru")
        @elseif(Auth::user()->akses == "WAKEL")
            @include("modules.layouts.components.sidebar.sidebar-wakel")
        @endif

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                @include('modules.layouts.components.navbar.navbar')

                @stack('modules-content')
            </div>

            @include('modules.layouts.components.footer.footer')

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('modules.layouts.components.modal.modal')

    @include('modules.layouts.components.js.javascript')

    @stack('modules-js')

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{!! session('success') !!}",
                icon: "success"
            });
        </script>
    @elseif(session("error"))
        <script>
            Swal.fire({
                title: "Gagal",
                text: "{!! session('error') !!}",
                icon: "error"
            });
        </script>
    @endif

</body>

</html>
