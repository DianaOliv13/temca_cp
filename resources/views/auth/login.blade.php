<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMCA — Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 420px;
        }
        .login-header {
            background: #212529;
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 30px;
            text-align: center;
        }
        .login-body {
            padding: 30px;
        }
        .btn-login {
            background: #212529;
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-login:hover {
            background: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-card card">
        <div class="login-header">
            <i class="bi bi-building fs-1"></i>
            <h4 class="fw-bold mt-2 mb-0">TEMCA</h4>
            <p class="mb-0 opacity-75">Costos y Presupuestos</p>
        </div>
        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Correo electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="correo@temca.com" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>