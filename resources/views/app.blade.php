<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/dropzone.css">
        <script type="text/javascript" src="/js/dropzone.js"></script>
    </head>

    <body>
        @include('partials.nav')
        @yield('content')


        @include('partials.footer')
    </body>
    <script type="text/javascript" src="/js/all.js"></script>
</html>

<script type="text/javascript">
	$(document).foundation();

        Dropzone.options.mainPhoto = {
            paramName: 'mainPhoto',
            maxFiles: 1,
            maxFileSize: 2,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
        };
        
        Dropzone.options.subPhotos = {
            paramName: 'photos',
            maxFileSize: 2,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp'

            }
</script>

