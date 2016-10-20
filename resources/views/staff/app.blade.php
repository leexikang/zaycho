<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body>

    <div class="row expanded body-color" data-sticky-container>

        @include('staff.partials.nav')

        @yield('content')

    </div>

    </body>
    <script type="text/javascript" src="/js/all.js"></script>
</html>

<script type="text/javascript">
	$(document).foundation();
</script>

