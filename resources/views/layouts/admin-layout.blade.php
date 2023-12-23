<!DOCTYPE html>
<html lang="en">
{{-- header --}}
@include('partials.header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<body>
@include('partials.navbar2')

<main style="margin-top: 58px;">
    <div class="container pt-4">
        @yield('content')
    </div>
  </main>

</body>
@include('partials.footer')
</html>
