<?php
declare(strict_types=1);

namespace Core;

use Core\Middleware\SessionMiddleware;

class Router
{
    protected string $controllerNamespace = 'App\\Controllers';

    public function dispatch(): void
    {
        // Obtener URL limpia
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $segments = explode('/', $url);

        // Controlador
        $controllerName = !empty($segments[0])
            ? ucfirst($segments[0]) . 'Controller'
            : 'HomeController';

        $controllerClass = $this->controllerNamespace . '\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            die('404 - Controlador no encontrado');
        }

        // Método
        $method = $segments[1] ?? 'index';

        // Si es POST y existe un método "store" o "update", lo usamos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Si la URL es /proyecto/create → método store()
            if ($method === 'create') {
                $method = 'store';
            }

            // Si la URL es /proyecto/edit/5 → método update(5)
            if ($method === 'edit') {
                $method = 'update';
            }
        }

        // Parámetros
        $params = array_slice($segments, 2);

        // Middleware de sesión
        $middleware = new SessionMiddleware();
        $middleware->handle($controllerName, $method);

        // Instanciar controlador
        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            die('404 - Método no encontrado');
        }

        // Ejecutar método
        call_user_func_array([$controller, $method], $params);
    }
}
