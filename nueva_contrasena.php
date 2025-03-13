<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Nueva Contraseña</h2>
                        <form action="actualizar_contrasena.php" method="post">
                            <input type="hidden" name="correo" value="<?php echo htmlspecialchars($_GET['correo']); ?>">
                            <div class="mb-3">
                                <label for="nueva_password" class="form-label">Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="nueva_password" name="nueva_password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (opcional, si necesitas funcionalidades JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>