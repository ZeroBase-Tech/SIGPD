<?php
session_start();

// Inicializamos array de jugadores si no existe
if (!isset($_SESSION['jugadores'])) {
  $_SESSION['jugadores'] = [];
}

// Agregamos último jugador si viene de login
if (isset($_SESSION['ultimo_jugador'])) {
  $nombre = $_SESSION['ultimo_jugador'];
  if (!in_array($nombre, $_SESSION['jugadores'])) {
    $_SESSION['jugadores'][] = $nombre;
  }
  unset($_SESSION['ultimo_jugador']);
}

if(isset($_POST['finalizar_partida'])){
    $_SESSION['jugadores'] = [];
    header("Location: resultados.php"); // Redirige a la página de resultados
    exit;
}

$jugadores = $_SESSION['jugadores'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DraftoTux - Tableros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/estilos.css">
  <style>
    .tablero-card {
      position: relative;
      width: 300px;
      height: 300px;
      margin: 10px;
      background-size: cover;
      border-radius: 12px;
      box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
      display: inline-block;
      vertical-align: top;
    }

    .tablero-card .nombre-jugador {
      position: absolute;
      top: 10px;
      left: 10px;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: bold;
    }

    .tablero-card .btn {
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      position: absolute;
    }
  </style>
</head>

<body class="bg-dark">

  <div id="background-blur" style="background-image: url('../../public/assets/img/Fondo.png');"></div>


  <div class="container py-4 text-center">
    <a href="../../public/index.php" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

    <?php if (empty($jugadores)): ?>
      <p class="text-white">No hay jugadores activos.</p>
    <?php else: ?>
      <?php foreach ($jugadores as $index => $nombre): ?>
        <div class="tablero-card" style="background-image: url('../../public/assets/img/Tablero.png');">
          <div class="nombre-jugador"><?= htmlspecialchars($nombre) ?></div>
          <a href="tablero-personal.php?jugador=<?= $index ?>" class="btn btn-success">Ver</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <div class="py-3 mt-4">
      <a class="btn btn-success fs-5" href="Cantidad.php">Atrás</a>
      <form method="post" style="display:inline-block; margin-left:10px;">
        <button type="submit" name="finalizar_partida" class="btn btn-danger fs-5">
            Partida Finalizada
        </button>
    </form>
    </div>
  </div>
    

</body>

</html>