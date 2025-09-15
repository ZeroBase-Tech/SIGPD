<?php
require_once __DIR__ . '/../model/Database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['contrasena'];
    $nombre = $_POST['nombre'];
    $confirmar = $_POST['confirmar_contrasena'];

    if ($password !== $confirmar) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $pdo = Database::getInstancia()->getConexion();

        $stmt = $pdo->prepare("SELECT * FROM Jugador WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $error = "El usuario ya existe.";
        } else {
            //$hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO Jugador (usuario, nombre, contraseña) VALUES (:usuario, :nombre, :password)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':password', $password);
            //$stmt->bindParam(':password', $hash);
            $stmt->execute();

            $success = "Usuario registrado con éxito.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DraftoTux - Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body class="bg-dark">

<div id="background-blur" style="background-image: url('../../public/assets/img/Fondo.png');"></div>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">

    <a href="../../public/index.php" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

    <div class="card p-4 rounded-5 w-100" style="max-width: 28rem;">
        <div class="card-header">
            <p class="fs-3 mb-0">Registro</p>
        </div>

        <?php if ($error) : ?>
            <div class="alert alert-danger mt-3"><?= $error ?></div>
        <?php elseif ($success) : ?>
            <div class="alert alert-success mt-3"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="registro.php">
            <div class="text-start mb-3">
                <label>Usuario</label>
                <input type="text" class="form-control" name="usuario" required>
            </div>

            <div class="text-start mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="text-start mb-3">
                <label>Contraseña</label>
                <input type="password" class="form-control" name="contrasena" required>
            </div>

            <div class="text-start mb-3">
                <label>Confirmar Contraseña</label>
                <input type="password" class="form-control" name="confirmar_contrasena" required>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-success fs-4">Registrar</button>
            </div>
        </form>

        <div class="mt-4 text-start">
            <a href="inicio_sesion.php" class="col-6 text-decoration-none">Atras</a>
        </div>
    </div>
</div>

</body>
</html>
