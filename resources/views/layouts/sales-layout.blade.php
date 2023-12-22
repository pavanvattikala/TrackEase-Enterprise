<!DOCTYPE html>
<html lang="en">
{{-- header --}}
@include('partials.header')

<body>
{{ $slot }}
</body>
@include('partials.footer')
</html>
