<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS - @yield('title', 'Inicio')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand ms-5" href="/">
                <img src="{{ asset('images/logo-uts.png') }}" alt="UTS Logo" height="60">
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-uts-green text-dark fw-bold px-4">
                    <i class="bi bi-person-circle me-2"></i>Iniciar Sesión
                </a>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">2025 UTS - Unidades Tecnológicas de Santander</p>
                    <p class="small">¡Lo hacemos posible!</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Santander - Colombia</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>