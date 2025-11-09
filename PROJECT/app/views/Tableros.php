<?php
$jugadores = $_SESSION['jugadores'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DraftoTux</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/Style.css">
</head>
<body class="bg-dark">
  <div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>
  <div class="container py-4 text-center">
    <a href="index.php?ruta=Start" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>
    <?php if (empty($jugadores)): ?>
      <p class="text-white">No hay jugadores activos.</p>
    <?php else: ?>
      <?php foreach ($jugadores as $index => $id_jugador): ?>
        <div class="tablero-card" style="background-image: url('assets/img/Tablero.png');">
          <div class="nombre-jugador"><?= htmlspecialchars($id_jugador) ?></div>
          <a href="index.php?ruta=Personal&jugador=<?= $index ?>" class="btn btn-success">Ver</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <div class="py-3 mt-4">
      <a class="btn btn-success fs-5" href="index.php?ruta=MatchLeft">Atrás</a>
      <a href="index.php?ruta=MatchEnd" class="btn btn-danger fs-5">Partida Finalizada</a>
    </div>
  </div>
</body>
</html>
