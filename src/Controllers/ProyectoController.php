<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Proyecto;
use Core\View;

class ProyectoController
{
    private function requireLogin(): int
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

        return (int) $_SESSION['user_id'];
    }

    private function findUserProjectOrFail(int $id, int $userId): Proyecto
    {
        $proyecto = Proyecto::where('proyecto_id', $id)
            ->where('usuario_id', $userId)
            ->first();

        if (!$proyecto) {
            http_response_code(403);
            die("No tienes permiso para acceder a este proyecto.");
        }

        return $proyecto;
    }

    public function index()
    {
        $userId = $this->requireLogin();

        $proyectos = Proyecto::with(['tareas.usuario', 'tareas.estado'])
            ->where('usuario_id', $userId)
            ->get();

        return View::render('proyecto/index', [
            'proyectos' => $proyectos
        ]);
    }

    public function create()
    {
        $this->requireLogin();

        return View::render('proyecto/create');
    }

    public function store()
    {
        $userId = $this->requireLogin();

        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $comentarios = trim($_POST['comentarios'] ?? '');

        if ($titulo === '') {
            return View::render('proyecto/create', [
                'error' => 'El título es obligatorio'
            ]);
        }

        Proyecto::create([
            'titulo'      => $titulo,
            'descripcion' => $descripcion,
            'fecha_inicio'=> date('Y-m-d'),
            'usuario_id'  => $userId
        ]);

        header("Location: " . BASE_URL . "proyecto");
        exit;
    }

    public function edit()
    {
        $userId = $this->requireLogin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $proyecto = $this->findUserProjectOrFail($id, $userId);

        return View::render('proyecto/edit', [
            'proyecto' => $proyecto
        ]);
    }

    public function update()
    {
        $userId = $this->requireLogin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $proyecto = $this->findUserProjectOrFail($id, $userId);

        $proyecto->titulo      = trim($_POST['titulo'] ?? '');
        $proyecto->descripcion = trim($_POST['descripcion'] ?? '');
        $proyecto->comentarios = trim($_POST['comentarios'] ?? '');
        $proyecto->save();

        header("Location: " . BASE_URL . "proyecto");
        exit;
    }

    public function delete()
    {
        $userId = $this->requireLogin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $proyecto = $this->findUserProjectOrFail($id, $userId);

        $proyecto->delete(); // ON DELETE CASCADE eliminará tareas

        header("Location: " . BASE_URL . "proyecto");
        exit;
    }
}
