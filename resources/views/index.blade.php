<!DOCTYPE html>
<html>
<head>
    @include('partials.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Header-->
    @include('partials.header')
    <!-- Sidebar -->
    @include('partials.sidebar')

    <div class="content-wrapper">
        <!-- Your Page Content Here -->
        @yield('content')
    </div>
    <!-- Footer-->
    @include('partials.footer')
</div>
<!-- Script-->
@include('partials.scripts')
</body>
</html>
