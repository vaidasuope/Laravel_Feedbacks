<!DOCTYPE html>
<html lang="en">

@include('_partials/head')

<body>

<!-- Navigation -->
@include('_partials/nav')

<!-- Page Header -->
@include('_partials/header')
<hr>
<!-- Main Content -->
<div class="container">
    @yield('content')
</div>



<!-- Footer -->
{{--@include('_partials/footer')--}}

{{--<!-- Bootstrap core JavaScript -->--}}
{{--<script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}

{{--<!-- Custom scripts for this template -->--}}
{{--<script src="{{URL::asset('js/clean-blog.min.js')}}"></script>--}}

</body>

</html>
