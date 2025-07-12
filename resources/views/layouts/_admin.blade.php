<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Panel de Administración')</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  @include('layouts.navbar')
  @include('layouts.sidebar')

  <div class="content-wrapper pt-3 px-4">
    @yield('content')
  </div>

  @include('layouts.footer')
</div>

<!-- Scripts AdminLTE -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<!-- Livewire correctamente vinculado -->
@livewireScripts
@stack('scripts')
</body>
</html>
