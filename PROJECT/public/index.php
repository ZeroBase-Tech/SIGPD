<?php
session_start();
require_once __DIR__ . '/../app/model/Database.php';
require_once __DIR__ . '/../app/model/Usuario.php';
require_once __DIR__ . '/../app/controller/UsuarioController.php';
require_once __DIR__ . '/../app/controller/JugadorController.php';
require_once __DIR__ . '/../app/controller/TableroController.php';


// Front Controller

$ruta = $_GET['ruta'] ?? 'Start'; 

$usuarioController = new UsuarioController();
$tableroController = new TableroController();
$jugadorController = new JugadorController();

switch ($ruta) {
    case 'Start':
        require_once __DIR__ . '/../app/views/inicio.html';
        break;
    case 'Home':
        require_once __DIR__ . '/../app/views/menu.php';
        break;
    case 'Creditos':
        require_once __DIR__ . '/../app/views/creditos.html';
        break;
    case 'Jugadores':
        if (isset($_GET['eliminar'])) {
        $jugadorController->eliminarJugador((int)$_GET['eliminar']);
    } else {
        $jugadorController->mostrarJugadores();
    }
    break;
    case 'Opciones':
	require_once __DIR__ . '/../app/views/opciones.html';
	break;
    case 'Ranking':
	require_once __DIR__ . '/../app/views/resultados.php';
	break;
    case 'Boards':
	$tableroController->mostrarTableros();
	break;
    case 'Personal':
	$tableroController->mostrarTablero();
	break;
    case 'LogIn':
	 $usuarioController->login();
	break;
    case 'SignIn':
     $usuarioController->register();
	break;
    default:
        echo '<h1>Error 404</h1>';
        break;
}
