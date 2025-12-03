<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | NutriFarm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Estilos específicos para el login (centrado) */
        body.login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--color-background);
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        .login-container h1 {
            color: var(--color-primary);
            margin-bottom: 25px;
            font-size: 1.8rem;
        }
        .login-container .logo i {
            font-size: 3rem;
            color: var(--color-accent);
            margin-bottom: 15px;
        }
        .btn-login {
            width: 100%;
            margin-top: 15px;
        }
        /* Override de estilos de formulario para el login */
        .form-group {
            text-align: left;
        }
    </style>
</head>
<body class="login-page">

<div class="login-container">
    <div class="logo">
        <i class="fas fa-seedling"></i>
    </div>
    <h1>Inicio de Sesión</h1>

    <form action="{{ url('login') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert error-alert" style="text-align: left; margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
            </div>
        @endif

        <div class="form-group">
            <label for="telefono"><i class="fas fa-phone"></i> Teléfono (Usuario):</label>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i> Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
    </form>
</div>

</body>
</html>
