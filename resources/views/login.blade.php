@extends('layouts.app')

@section('title', 'Iniciar Sesión - UTS')
@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-80">
            <div class="col-lg-10">
                <div class="login-wrapper">
                    <div class="row g-0">
                        <div class="col-lg-6 login-info-side">
                            <div class="info-content">
                                <div class="logo-section mb-4">
                                    <img src="{{ asset('images/logo-uts.png') }}" alt="UTS Logo" class="login-logo">
                                </div>

                                <h2 class="info-title">Portal Administrativo y Docente</h2>
                                <div class="back-link mt-5">
                                    <a href="{{ route('home') }}">
                                        <i class="bi bi-arrow-left me-2"></i>Volver al portal informativo
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 login-form-side">
                            <div class="form-content">
                                <div class="form-header">
                                    <h3>Iniciar Sesión</h3>
                                </div>

                                <form class="login-form" id="loginForm">
                                    <div class="form-group">
                                        <label for="username">
                                            <i class="bi bi-person me-2"></i>Usuario
                                        </label>
                                        <input type="text" class="form-control" id="username"
                                            placeholder="Ingresa tu usuario" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="bi bi-lock me-2"></i>Contraseña
                                        </label>
                                        <div class="password-wrapper">
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Ingresa tu contraseña" required>
                                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                                <i class="bi bi-eye" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-options">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember">
                                            <label class="form-check-label" for="remember">
                                                Recordarme
                                            </label>
                                        </div>
                                        <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <a href="{{ url('/admin/dashboard') }}" class="btn-login">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                        Iniciar Sesión
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>

</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}
</script>
@endpush