<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$correo = $_POST['correo'];
$password = $_POST['password'];

// Buscar el usuario en la base de datos
$sql = "SELECT u.*, r.descripcion_rol FROM usuario u JOIN rol r ON u.rol = r.id_rol WHERE u.correo = '$correo' AND u.password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario autenticado
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['usuario'] = $row['nombre'];
    $_SESSION['rol'] = $row['descripcion_rol'];
    $_SESSION['codigo_usuario'] = $row['codigo_usuario'];

    // Mostrar mensaje de éxito y redirigir
    echo "<!DOCTYPE html>
          <html lang='es'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Redirección</title>
              <!-- SweetAlert2 CSS -->
              <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
              <!-- SweetAlert2 JS -->
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head>
          <body>
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Éxito',
                      text: 'Autenticación exitosa. Redirigiendo...'
                  }).then(() => {
                      window.location.href = 'perfil.php';
                  });
              </script>
          </body>
          </html>";
    exit();
} else {
    // Autenticación fallida
    echo "<!DOCTYPE html>
          <html lang='es'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Redirección</title>
              <!-- SweetAlert2 CSS -->
              <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
              <!-- SweetAlert2 JS -->
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head>
          <body>
              <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'Correo o contraseña incorrectos.'
                  }).then(() => {
                      window.location.href = 'index.html';
                  });
              </script>
          </body>
          </html>";
}

$conn->close();
?>