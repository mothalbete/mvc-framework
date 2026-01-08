<?php
declare(strict_types=1);

namespace Core;

class Controller
{
    /**
     * Carga una vista y le pasa datos
     *
     * @param string $view  Ruta de la vista (sin .php)
     *                      Ej: 'home/index'
     * @param array  $data  Datos para la vista
     */
    protected function view(string $view, array $data = []): void
{
    extract($data);

    $viewFile = __DIR__ . '/../src/Views/' . $view . '.php';
    $layoutFile = __DIR__ . '/../src/Views/layout.php';

    if (!file_exists($viewFile)) {
        die("❌ Vista no encontrada: $view");
    }

    require $layoutFile;
}


    /**
     * Redirección HTTP
     */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
