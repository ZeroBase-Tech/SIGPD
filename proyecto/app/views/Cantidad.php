<?php
session_start();

// Crear array de jugadores si no existe
if (!isset($_SESSION['jugadores'])) {
  $_SESSION['jugadores'] = [];
}

// Si hay un último jugador que inició sesión, agregarlo al primer div vacío
if (isset($_SESSION['ultimo_jugador'])) {
  $agregado = false;
  for ($i = 0; $i < 5; $i++) {
    if (!isset($_SESSION['jugadores'][$i])) {
      $_SESSION['jugadores'][$i] = $_SESSION['ultimo_jugador'];
      $agregado = true;
      break;
    }
  }
  if ($agregado) {
    unset($_SESSION['ultimo_jugador']); // Limpiar temporal
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Draftotux</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="../../public/css/estilos.css">
</head>

<body class="bg-dark">

  <div id="background-blur" style="background-image: url('../../public/assets/img/Fondo.png');"></div>
  <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center px-3">
    <a href="../../public/index.php" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

    <div class="card text-white rounded-4 shadow w-100 pt-4" style="max-width: 32rem;">
      <div class="row d-flex gap-3 justify-content-center mb-3">
        <?php
        for ($i = 0; $i < 5; $i++) {
          $nombre = $_SESSION['jugadores'][$i] ?? "Usuario " . ($i + 1);
        ?>
          <div class="jugador-card col-12 col-sm-6">
            <p class="close-btn">X</p>
            <a href="inicio_sesion.php">
              <div class="jugador-card2">
                <img src="../../public/assets/img/tux.png">
                <div class="add-usuario">+</div>
              </div>
            </a>
            <label><?= htmlspecialchars($nombre) ?></label>
          </div>
        <?php } ?>
      </div>

      <div class="row d-flex justify-content-center mb-3">
        <div class="col-5">
          <button class="btn btn-outline-light">Modo Digital</button>
        </div>
        <div class="col-5">
          <a class="btn btn-outline-light" href="tableros.php">Modo Seguimiento</a>
        </div>
      </div>
    </div>
    <div class="py-3">
      <a class="btn btn-success w-100 fs-5" href="menu.php">Atrás</a>
    </div>
  </div>
</body>

</html>