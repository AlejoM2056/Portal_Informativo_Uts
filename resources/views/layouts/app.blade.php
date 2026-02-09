<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS - @yield('title', 'Inicio')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    @stack('styles')
</head>
<body>
    <div class="contain-nav-hero">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container-fluid px-4">
                <a id="contain-desktop-logos" class="navbar-brand ms-5" href="/">
                    <img src="{{ asset('images/favicon.png') }}" alt="Favicon" height="50">
                    <img src="{{ asset('images/escudo-uts.png') }}" alt="UTS Logo" height="50">
                </a>
                <a id="contain-mobile-logos" class="navbar-brand" href="/">
                    <img src="{{ asset('images/programa-logo.png') }}" alt="Favicon" height="50">
                </a>
                <div class="ms-auto">
                    <a href="https://sistemastg.uts.edu.co/tg" target="_blank" class="btn btn-uts-green px-3">
                        <i class="bi bi-person-circle me-2"></i>Sistemas TG
                    </a>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
    <footer class="footer-uts">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ asset('images/logo-uts.png') }}" alt="UTS Logo" class="uts-logo">
            </div>
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Unidades Tecnológicas de Santander</h4>
                    <p>Facultad de Ingeniería de Sistemas</p>
                </div>
                <div class="footer-section">
                    <p><i class="bi bi-geo-alt-fill"></i> Calle de los Estudiantes #9-82<br>Edificio C Piso 2 / Bucaramanga</p>
                    <p><i class="bi bi-envelope-fill"></i> sistemas@correo.uts.edu.co</p>
                </div>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/UnidadesTecnologicasdeSantanderUTS" class="social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://x.com/Unidades_UTS" class="social-link" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.instagram.com/unidades_uts" class="social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/@unidades_uts/" class="social-link" title="YouTube"><i class="bi bi-youtube"></i></a>
                <a href="https://t.me/ingsistemasuts" class="social-link" title="Telegram"><i class="bi bi-telegram"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Unidades Tecnológicas de Santander - Todos los derechos reservados</p>
            <p class="footer-tagline">¡Lo hacemos posible!</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
