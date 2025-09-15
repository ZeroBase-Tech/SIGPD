<?php
session_start();

// Obtener el jugador que está viendo este tablero
$jugador_index = $_GET['jugador'] ?? 0;
$jugadores = $_SESSION['jugadores'] ?? [];
$nombre_jugador = $jugadores[$jugador_index] ?? "Jugador " . ($jugador_index + 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DraftoTux - Tablero de <?= htmlspecialchars($nombre_jugador) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>

<body class="bg-dark">

    <div id="background-blur" style="background-image: url('../../public/assets/img/Fondo.png');"></div>

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center px-3">
       <a href="../../public/index.php" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

        <div class="tablero" style="background-image: url('../../public/assets/img/Tablero.png');">
            <div class="usuario"><?= htmlspecialchars($nombre_jugador) ?></div>
            <div id="Semejanza" class="casilla casilla_compuesta" style="top:40px; left:30px;"></div>
            <div id="Rey" class="casilla casilla_simple" style="top:65px; left:330px;"></div>
            <div id="Trio" class="casilla casilla_compuesta" style="top:210px; left:30px;"></div>
            <div id="Diferencia" class="casilla casilla_compuesta" style="top:210px; left:310px;"></div>
            <div id="Amor" class="casilla casilla_compuesta" style="top:370px; left:35px;"></div>
            <div id="Isla" class="casilla casilla_simple" style="top:375px; left:330px;"></div>
            <div id="Rio" class="casilla casilla_rio" style="top:30px; left:220px;"></div>
        </div>

        <div class="barra_inferior mt-3">
            <img src="../../public/assets/img/ficha-arch.png" class="ficha" id="ficha-arch" draggable="true">
            <img src="../../public/assets/img/ficha-debian.png" class="ficha" id="ficha-debian" draggable="true">
            <img src="../../public/assets/img/ficha-fedora.png" class="ficha" id="ficha-fedora" draggable="true">
            <img src="../../public/assets/img/ficha-mint.png" class="ficha" id="ficha-mint" draggable="true">
            <img src="../../public/assets/img/ficha-ubuntu.png" class="ficha" id="ficha-ubuntu" draggable="true">
            <img src="../../public/assets/img/ficha-suse.png" class="ficha" id="ficha-suse" draggable="true">
        </div>

        <div class="mt-4">
            <a class="btn btn-success w-100 fs-5" href="tableros.php">Atras</a>
        </div>
    </div>

    <script>
        let Diferencia = new Array(6);
  let Igualdad;
  let Trio;
  // Limites por casilla (id de la casilla: cantidad máxima)
  const limites = {
    Semejanza: 6,
    Rey: 1,
    Trio: 3,
    Diferencia: 6,
    Isla: 1,
  };

  // Activar drag en todas las fichas
  const fichas = document.querySelectorAll('.ficha');
  fichas.forEach(ficha => {
    ficha.addEventListener('dragstart', e => {
      e.dataTransfer.setData('id', e.target.id);
    });
  });

  // Seleccionamos todas las casillas
  const casillas = document.querySelectorAll('.casilla');
  casillas.forEach(casilla => {

    casilla.addEventListener('dragover', e => e.preventDefault());

    casilla.addEventListener('drop', e => {
      e.preventDefault();
      
      const tipo = e.dataTransfer.getData('id');
      const ficha = document.getElementById(tipo);

      const limite = limites[casilla.id]; // undefined si no tiene límite
      const fichasEnCasilla = casilla.querySelectorAll('.ficha').length;

      if ( fichasEnCasilla && casilla.id == "Diferencia" ){
        for( let i = 0; i < Diferencia.length; i++ ){
          if( Diferencia[i] == ficha.id ){
            alert(`${ficha.id} ya fue colocado en la casilla`);
            return;
          }
        }
      }

      if ( !fichasEnCasilla && casilla.id == "Semejanza" ) {
        Igualdad = ficha.id;
      }
      if ( !fichasEnCasilla && casilla.id == "Trio" ) {
        Trio = ficha.id;
      }
      if ( casilla.id == "Diferencia" ) {
        Diferencia[fichasEnCasilla] = ficha.id;
      }

      //Rechazar ficha si 
        // Maximo numero de fichas en la casilla
        //Tipo de ficha incorrecto 
      if ( fichasEnCasilla >= limite ) {
        alert(`Esta casilla ya alcanzó su límite de ${limite} fichas!`);
        return;
      }
      if ( fichasEnCasilla && casilla.id == "Semejanza" ) {
        if ( Igualdad != ficha.id ) {
          alert(`Solo ${Igualdad} pueden colocarse en esta castilla`);
          return;
        }
      }
      if ( fichasEnCasilla && casilla.id == "Trio" ) {
        if ( Trio != ficha.id ) {
          alert(`Solo ${Trio} pueden colocarse en esta castilla`);
          return;
        }
      }

      // Si viene de la barra inferior, clonamos
      if (ficha.parentElement.classList.contains('barra_inferior')) {
        const copia = ficha.cloneNode(true);
        copia.id = tipo + '-' + Date.now();
        copia.addEventListener('dragstart', e => {
          e.dataTransfer.setData('id', e.target.id);
        });
        casilla.appendChild(copia);
      } else {
        // Si viene de otra casilla, la movemos
        casilla.appendChild(ficha);
      }
      
      //Informacion de fondo
      console.log("Casilla: " + casilla.id);
      console.log("Limite: " + limite);
      console.log("Num Fichas: " + fichasEnCasilla);
      console.log("Ficha: " + ficha.id);  

    });
  });
    </script>

</body>

</html>