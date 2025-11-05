<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DraftoTux - Tablero de <?= htmlspecialchars($nombre_jugador) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/tablero-personal.css">
  
</head>

<body class="bg-dark">

    <div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center px-3">
       <a href="index.php?ruta=Start" class="text-decoration-none">
      <h1 class="blinker-semibold" style="position: relative; top: 20px;" >DraftoTux</h1>
    </a>
    
     <div class="barra_puntos row">
      <h4 class="mb-0 text-white">Puntos: <span class="puntos">0</span></h4>
    </div>
        <div class="tablero">
            <div class="usuario"><?= htmlspecialchars($nombre_jugador) ?></div>
            <div id="Semejanza" class="casilla casilla_compuesta" style="top:40px; left:30px;"></div>
            <div id="Rey" class="casilla casilla_simple" style="top:65px; left:330px;"></div>
            <div id="Trio" class="casilla casilla_compuesta" style="top:210px; left:30px;"></div>
            <div id="Diferencia" class="casilla casilla_compuesta" style="top:210px; left:310px;"></div>
            <div id="Amor" class="casilla casilla_amor" style="top:370px; left:35px;"></div>
            <div id="Isla" class="casilla casilla_simple" style="top:375px; left:330px;"></div>
            <div id="Rio" class="casilla casilla_rio" style="top:30px; left:220px;"></div>
        </div>
 
       <div class="barra_dado py-3 mx-2" style="position: relative; left: 330px; top: 35px;">
          <div class="form-check form-switch pb-2">
            <input class="form-check-input" type="checkbox" role="switch" id="switchOnOff">
            <label class="form-check-label text-white" for="switchOnOff">Turno</label>
          </div>

   
        <div class="btn-group-vertical" role="group" aria-label="Seleccionar dado">
   
          <input type="radio" class="btn-check" name="dado" id="dado-arch" autocomplete="off">
          <label class="btn btn-outline-success p-1" for="dado-arch">
            <img src="assets/img/DadoArch.png" class="img-fluid" style="width:70px;">
          </label>

          <input type="radio" class="btn-check" name="dado" id="dado-vacio" autocomplete="off">
          <label class="btn btn-outline-success p-1" for="dado-vacio">
            <img src="assets/img/DadoVacio.png" class="img-fluid" style="width:70px;">
          </label>

          <input type="radio" class="btn-check" name="dado" id="dado-verde" autocomplete="off">
          <label class="btn btn-outline-success p-1" for="dado-verde">
            <img src="assets/img/DadoVerde.png" class="img-fluid" style="width:70px;">
          </label>

        
          <input type="radio" class="btn-check" name="dado" id="dado-gris" autocomplete="off">
          <label class="btn btn-outline-success p-1" for="dado-gris">
            <img src="assets/img/DadoGris.png" class="img-fluid" style="width:70px;">
          </label>

        
          <input type="radio" class="btn-check" name="dado" id="dado-terminal" autocomplete="off">
          <label class="btn btn-outline-success p-1" for="dado-terminal">
            <img src="assets/img/DadoTerminal.png" class="img-fluid" style="width:70px;">
          </label>

         
          <input type="radio" class="btn-check" name="dado" id="dado-cafe" autocomplete="off">
          <label class="btn btn-outline-success p-1" for="dado-cafe">
            <img src="assets/img/DadoCafe.png" class="img-fluid" style="width:70px;">
          </label>
        </div>
      </div>

      

        <div class="barra_inferior mt-3" style="position: relative; bottom: -30px;">
            <img src="assets/img/ficha-arch.png" class="ficha" id="ficha-arch" draggable="true">
            <img src="assets/img/ficha-debian.png" class="ficha" id="ficha-debian" draggable="true">
            <img src="assets/img/ficha-fedora.png" class="ficha" id="ficha-fedora" draggable="true">
            <img src="assets/img/ficha-mint.png" class="ficha" id="ficha-mint" draggable="true">
            <img src="assets/img/ficha-ubuntu.png" class="ficha" id="ficha-ubuntu" draggable="true">
            <img src="assets/img/ficha-suse.png" class="ficha" id="ficha-suse" draggable="true">
        </div>

        <div class="mt-4" style="position: relative; bottom: -20px;">
            <a class="btn btn-success w-100 fs-5" href="index.php?ruta=Boards">Atras</a>
        </div>

      <div id="alert-container"
         class="mt-4" style="position: absolute; top: 100px; z-index:9999; min-width: 250px;">
      </div>
    </div>

  <script src="js/tablero.js"></script>

</body>


</html>
