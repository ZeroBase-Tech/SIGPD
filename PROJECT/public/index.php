<?php
session_start();

require_once __DIR__ . '/../app/controller/UsuarioController.php';
$UsuarioController = new UsuarioController();

require_once __DIR__ . '/../app/controller/TableroController.php';
$TableroController = new TableroController();

require_once __DIR__ . '/../app/controller/JugadorController.php';
$JugadorController = new JugadorController();

echo '<link href="https://fonts.googleapis.com/css2?family=Blinker:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">';

$ruta = $_GET['ruta'] ?? 'Start';

switch ($ruta) {
	#Views
	case 'Start':
		require_once __DIR__ . '/../app/views/Inicio.html';
	break;
	case 'Menu':
		require_once __DIR__ . '/../app/views/Menu.html';
	break;
	case 'Jugadores':
		if (isset($_GET['eliminar'])) {
         $JugadorController->eliminarJugador((int)$_GET['eliminar']);
		} else {
		 $JugadorController->mostrarJugadores();
		}
	break;
	case 'Opciones':
		require_once __DIR__ . '/../app/views/Opciones.html';
	break;
	case 'Ranking':
		require_once __DIR__ . '/../app/views/Resultados.php';
	break;
	case 'Creditos':
		require_once __DIR__ . '/../app/views/Creditos.html';
	break;
	case 'Tableros':
		$TableroController->mostrarTableros();
	break;
	case 'Personal':
		$TableroController->mostrarTablero();
	break;
	case 'LogIn':
		$UsuarioController->login();
	break;
	case 'SignIn':
		$UsuarioController->register();
	break;
	#Default
	default:
		echo '<h1>ERROR 404</h1>';
	break;
}
?>
