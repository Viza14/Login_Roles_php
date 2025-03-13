<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$rol = $_SESSION['rol'];
$codigo_usuario = $_SESSION['codigo_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 15px;
            font-weight: bold;
        }
        .card-body {
            padding: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Título de bienvenida -->
        <div class="text-center mb-5">
            <h1 class="display-4">Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
            <p class="lead">Esta es tu página de perfil. Aquí puedes gestionar tu cuenta.</p>
        </div>

        <!-- Contenedor de la cuadrícula -->
        <div class="grid-container">
            <!-- Opción para cambiar contraseña -->
            <div class="card">
                <div class="card-header">
                    Cambiar Contraseña
                </div>
                <div class="card-body">
                    <form action="cambiar_password.php" method="post">
                        <div class="mb-3">
                            <label for="nueva_password" class="form-label">Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="nueva_password" name="nueva_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    </form>
                </div>
            </div>

            <!-- Opción para cambiar correo -->
            <div class="card">
                <div class="card-header">
                    Cambiar Correo Electrónico
                </div>
                <div class="card-body">
                    <form action="cambiar_correo.php" method="post">
                        <div class="mb-3">
                            <label for="nuevo_correo" class="form-label">Nuevo Correo Electrónico:</label>
                            <input type="email" class="form-control" id="nuevo_correo" name="nuevo_correo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar Correo</button>
                    </form>
                </div>
            </div>

            <!-- Opción para agregar roles (solo para admin) -->
            <?php if ($rol == 'admin'): ?>
            <div class="card">
                <div class="card-header">
                    Agregar Roles
                </div>
                <div class="card-body">
                    <form action="agregar_rol.php" method="post">
                        <div class="mb-3">
                            <label for="descripcion_rol" class="form-label">Descripción del Rol:</label>
                            <input type="text" class="form-control" id="descripcion_rol" name="descripcion_rol" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Rol</button>
                    </form>
                </div>
            </div>

            <!-- Opción para agregar un nuevo usuario (solo para admin) -->
            <div class="card">
                <div class="card-header">
                    Agregar Nuevo Usuario
                </div>
                <div class="card-body">
                    <form action="agregar_usuario.php" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol:</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <?php
                                // Conectar a la base de datos y obtener los roles
                                $conn = new mysqli("localhost", "root", "", "proyecto");
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }
                                $sql = "SELECT * FROM rol";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id_rol']}'>{$row['descripcion_rol']}</option>";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Botón para cerrar sesión -->
        <div class="d-grid mt-4">
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, si necesitas funcionalidades JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <br>
</footer>
</html>