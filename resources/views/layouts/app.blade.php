<!DOCTYPE html>
<html lang="en">
{{-- header --}}
@include('partials.header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<body>
@include('partials.navbar2')
@yield('content')
</body>
@include('partials.footer')
</html>
