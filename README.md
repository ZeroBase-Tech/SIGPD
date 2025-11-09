Configuración de conexión a la base de datos

El proyecto incluye dos configuraciones de conexión a la base de datos: una para XAMPP y otra para Docker.
Por defecto, el código está preparado para ejecutarse en XAMPP, pero puede cambiarse fácilmente para funcionar dentro de un entorno Docker Compose.

Conexión para XAMPP (por defecto)
define('SERVERNAME', '127.0.0.1'); // Host de MySQL en XAMPP
define('USERNAME', 'root');         // Usuario de MySQL (por defecto 'root')
define('PASSWORD', '');             // Contraseña (por defecto vacía)
define('DBNAME', 'draftotux');      // Nombre de la base de datos

Esta configuración permite ejecutar el sistema desde un entorno local con Apache y MySQL instalados mediante XAMPP.

Conexión para Docker
Si se ejecuta el proyecto dentro del entorno de Docker Compose, solo se deben descomentar las siguientes líneas y comentar las anteriores:

//define('SERVERNAME', 'database'); // 'database' es el nombre del servicio MySQL en docker-compose
//define('USERNAME', 'root');       // Usuario definido en docker-compose
//define('PASSWORD', 'Manzana@13'); // Contraseña definida en docker-compose
//define('DBNAME', 'draftotux');    // Nombre de la base de datos definido en docker-compose

Con esta configuración, la aplicación se conectará automáticamente al contenedor de base de datos MySQL creado por Docker.


# Draftux
Una aplicacion web de seguimiento del juego de mesa Draftousaurus
## Instrucciones de uso
### Preparacion y Registro
- Preparar el juego de la manera detallada en el [**Manual del Juego**](https://drive.google.com/file/d/138qY_aZfQ-RXYDA0j6HshSk-_1mmJIrG/view)
- Interactuar con el boton *!Comenzar Juego!*
- **(Opcional)** Interactuar con el boton *Opciones* y editar opciones a su preferencia
- Interactaur con el boton *Jugar*
- Interactuar con el boton *Modo de Seguimiento*
- Interactuar con la imagen de tux +
- Interactuar con el boton *Registrar*
- Ingresar la informacion requerida y interactuar con el boton *Registrar*
### Inicio del Juego
- Luego de registrar los jugadores, Interactuar con los botones debajo del tablero para registrar los dinosaurios en tu mano y el efecto de dado
- Seleccionar uno de los dinosaurios y colocarlos en un recinto. Repetir esta seleccion en el tablero fisico
- Interactuar con el boton *Siguiente* y pasar la aplicacion a el siguiente jugador
- Repetir estos 2 pasos hasta el fin de la primera ronda
- Ingresar los dinosaurios en tu mano una vez mas
- Repetir los 2 pasos de la primera ronda hasta el fin del juego
- Interactuar con el boton *Fin*
- Comparar los resultados del juego y decidir el ganador.
