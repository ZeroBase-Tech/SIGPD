<?php
$error = $error ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Draftotux</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/Style.css">
</head>
<body class="bg-dark">
  <div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>
  <div class="container d-flex flex-column justify-content-center align-items-center text-center py-3">
    <a href="index.php?ruta=Start" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>
    <div class="card p-4 rounded-5 w-100 " style="max-width: 28rem;">
      <div class="card-header">
        <p class="fs-3 mb-0">Iniciar Sesión</p>
      </div>
      <form method="POST" action="index.php?ruta=LogIn">
        <?php if (!empty($error)) : ?>
          <div class="alert alert-danger mt-3"><?= $error ?></div>
        <?php endif; ?>
        <div class="mb-3 mt-3 text-start">
          <label>Usuario</label>
          <input type="text" class="form-control" name="usuario" required>
        </div>
        <div class="mb-4 text-start">
          <label>Contraseña</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-success fs-5">Iniciar Sesión</button>
        </div>
      </form>
      <div class="row mt-4">
        <a href="index.php?ruta=Jugadores" class="btn btn-outline-light col-5 text-start text-decoration-none fs-5">Atras</a>
		<p class="col-2"></p>
        <a href="index.php?ruta=Registro" class="btn btn-outline-light col-5 text-end text-decoration-none fs-5">Registrar</a>
      </div>
    </div>
  </div>
</body>
</html>
