<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ $title ?? config('app.name') }}
    </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/atv0zz5w87uf8ihnq71cwdpdyaknsvib3auq25226a3dha1y/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            language: 'cs',
            plugins: [
                'help', 'wordcount'
            ],
            content_style: 'img {max-width: 80vw}',
            menubar: 'file edit insert view tools help',
            toolbar: 'bold italic underline',
        });
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    @livewireStyles
    @powerGridStyles
</head>

<body class="antialiased">
<!--
                           _
                          | |
  ___   ___   __ _  __ _  | |__   ___   ___   __ _  __ _
 / _ \ / _ \ / _` |/ _` | | '_ \ / _ \ / _ \ / _` |/ _` |
| (_) | (_) | (_| | (_| | | |_) | (_) | (_) | (_| | (_| |
 \___/ \___/ \__, |\__,_| |_.__/ \___/ \___/ \__, |\__,_|
              __/ |                           __/ |
             |___/                           |___/
-->
<x-nav />
    <div class="container my-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="toast bg-danger text-white mx-auto mb-1" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $error }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="mt-2">
            {{ $slot }}
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
            $('[data-bs-toggle="popover"]').popover(
                {
                    trigger: 'hover',
                    placement: 'top',
                    html: true,
                    sanitize: false
                }
            );
        });
    </script>
    @livewireScripts
    @powerGridScripts
</body>

</html>
