<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, string $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, string $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch(): void
    {
        $uri = $_GET['url'] ?? '';
        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            die("404 - Ruta no encontrada");
        }

        [$controller, $action] = explode('@', $this->routes[$method][$uri]);

        $controllerClass = "App\\Controllers\\$controller";

        if (!class_exists($controllerClass)) {
            http_response_code(404);
            die("404 - Controlador no encontrado");
        }

        $instance = new $controllerClass();

        if (!method_exists($instance, $action)) {
            http_response_code(404);
            die("404 - Método no encontrado");
        }

        $instance->$action();
    }
}
