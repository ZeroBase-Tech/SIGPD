<?php

require_once '../app/model/Tablero.php';
require_once '../app/model/Partida.php';
require_once '../app/model/Usuario.php';

class TableroController {

private Usuario $ModeloUsuario;
public Partida $ModeloPartida;
private Tablero $ModeloTablero;

    public function mostrarTableros() {

        // Inicializamos array de jugadores si no existe
        if (!isset($_SESSION['jugadores'])) {
            $_SESSION['jugadores'] = [];
        }

        // Agregamos último jugador si viene del login
        if (isset($_SESSION['ultimo_jugador'])) {
            $nombre = $_SESSION['ultimo_jugador'];
            if (!in_array($nombre, $_SESSION['jugadores'])) {
                $_SESSION['jugadores'][] = $nombre;
            }
            unset($_SESSION['ultimo_jugador']);
        }

        // Si se finaliza partida
        if (isset($_POST['finalizar_partida'])) {
	    $_SESSION['Partida'] = [];
            $_SESSION['jugadores'] = [];
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?ruta=Ranking">';
        }

        $jugadores = $_SESSION['jugadores'];

	// Creando la partida en la base de datos.
	$this->ModeloPartida = new Partida();
	$PartidaID = $this->ModeloPartida->create();
	$_SESSION['Partida'] = $PartidaID;
	echo $PartidaID;
	// Creando los tableros en la base de datos
	$this->ModeloUsuario = new Usuario();
	if (empty($jugadores)){

	}else{
	 forEach ($jugadores as $index => $nombre){
          $id_jugador = $this->ModeloUsuario->getUserByUsername($nombre);

	  $this->ModeloTablero = new Tablero();
	  $this->ModeloTablero->create($id_jugador['id_jugador'], $_SESSION['Partida']);
	 }
	}

        include __DIR__ . '/../views/Tableros.php';
    }

    public function mostrarTablero() {
        $jugadores = $_SESSION['jugadores'] ?? [];
        $jugador_index = $_GET['jugador'] ?? 0;

        if (isset($jugadores[$jugador_index])) {
            $nombre_jugador = $jugadores[$jugador_index];
        } else {
            $nombre_jugador = "Jugador " . ($jugador_index + 1);
        }

        include __DIR__ . '/../views/Tablero-Personal.php';
    }
}
