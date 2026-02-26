<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Aguacate KBI</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">

<div class="login-container">
    <div class="logo">
        <i class="fas fa-seedling"></i>
    </div>
    <h1>Aguacate <strong>KBI</strong></h1>

    <form action="{{ url('login') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert error-alert" style="font-size: 0.85rem; margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
            </div>
        @endif

        <div class="form-group">
            <label for="telefono"><i class="fas fa-phone"></i> Teléfono (Usuario)</label>
            <input type="text" id="telefono" name="telefono"
                   placeholder="Ingresa tu número"
                   value="{{ old('telefono') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
            <input type="password" id="password" name="password"
                   placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-primary btn-login">
            <i class="fas fa-sign-in-alt"></i> Entrar al Sistema
        </button>
    </form>

    <p style="margin-top: 25px; font-size: 0.8rem; color: #777;">
        &copy; {{ date('Y') }} Sistema de Diagnóstico Mineral
    </p>
</div>

</body>
</html>
