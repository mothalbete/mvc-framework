<?php
declare(strict_types=1);

namespace Core;

class View
{
    public static function render(string $path, array $data = []): void
    {
        // Extrae variables para que estén disponibles en la vista
        extract($data);

        // Ruta del archivo de vista
        $viewFile = __DIR__ . '/../views/' . $path . '.php';

        if (!file_exists($viewFile)) {
            die("La vista no existe: $viewFile");
        }

        // El layout usará $viewFile para incluir la vista dentro
        require __DIR__ . '/../views/layout/main.php';
    }
}
