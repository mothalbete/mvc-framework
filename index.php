<?php
declare(strict_types=1);
session_start();

/*
|--------------------------------------------------------------------------
| FRONT CONTROLLER
|--------------------------------------------------------------------------
| Punto único de entrada de la aplicación
|--------------------------------------------------------------------------
*/

// 1. Autoload de Composer
require_once __DIR__ . '/vendor/autoload.php';

// 2. Configuración de base de datos
$dbConfig = require_once __DIR__ . '/config/database.php';

// 3. Cargar Router
require_once __DIR__ . '/core/Router.php';

use Core\Router;

$router = new Router();

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
$router->get('login', 'AuthController@login');
$router->post('login', 'AuthController@login');

$router->get('register', 'AuthController@register');
$router->post('register', 'AuthController@register');

$router->get('logout', 'AuthController@logout');

/*
|--------------------------------------------------------------------------
| RUTAS HOME
|--------------------------------------------------------------------------
*/
$router->get('', 'HomeController@index');
$router->get('home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| RUTAS PROYECTOS (con parámetros GET)
|--------------------------------------------------------------------------
*/
$router->get('proyecto', 'ProyectoController@index');
$router->get('proyecto/create', 'ProyectoController@create');
$router->post('proyecto/create', 'ProyectoController@store');

$router->get('proyecto/edit', 'ProyectoController@edit');     // ?id=3
$router->post('proyecto/edit', 'ProyectoController@update');

$router->get('proyecto/delete', 'ProyectoController@delete'); // ?id=3

/*
|--------------------------------------------------------------------------
| RUTAS TAREAS (con parámetros GET)
|--------------------------------------------------------------------------
*/
$router->get('tarea', 'TareaController@index');
$router->get('tarea/create', 'TareaController@create');
$router->post('tarea/create', 'TareaController@store');

$router->get('tarea/edit', 'TareaController@edit');           // ?id=5
$router->post('tarea/edit', 'TareaController@update');

$router->get('tarea/delete', 'TareaController@delete');       // ?id=5

/*
|--------------------------------------------------------------------------
| RUTA PERFIL USUARIO
|--------------------------------------------------------------------------
*/
$router->get('usuario', 'UsuarioController@index');

/*
|--------------------------------------------------------------------------
| EJECUTAR ROUTER
|--------------------------------------------------------------------------
*/
$router->dispatch();
