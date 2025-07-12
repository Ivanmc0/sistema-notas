<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Panel')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Estilos de AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="{{ asset('css/custom-admin.css') }}">
  
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  @include('layouts.navbar')
  @include('layouts.sidebar')

  <div class="content-wrapper">
    <section class="content pt-3 px-4">
      @yield('content')
    </section>
  </div>

  @include('layouts.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@livewireScripts
@stack('scripts')
@yield('scripts')

</body>
</html>
