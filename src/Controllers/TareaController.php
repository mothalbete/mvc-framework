<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Usuario;
use Core\View;

class TareaController
{
    private function requireLogin(): int
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

        return (int) $_SESSION['user_id'];
    }

    private function findUserTaskOrFail(int $id, int $userId): Tarea
    {
        // Solo permite acceder a tareas de proyectos del usuario
        $tarea = Tarea::where('tarea_id', $id)
            ->whereHas('proyecto', function ($q) use ($userId) {
                $q->where('usuario_id', $userId);
            })
            ->first();

        if (!$tarea) {
            http_response_code(403);
            die("No tienes permiso para acceder a esta tarea.");
        }

        return $tarea;
    }

    public function index()
    {
        $userId = $this->requireLogin();

        // 🔥 SOLO tareas asignadas al usuario logueado
        $tareas = Tarea::with(['proyecto', 'usuario', 'estado'])
            ->where('usuario_id', $userId)
            ->get();

        return View::render('tarea/index', [
            'tareas' => $tareas
        ]);
    }

    public function create()
    {
        $userId = $this->requireLogin();

        // Solo proyectos del usuario logueado
        $proyectos = Proyecto::where('usuario_id', $userId)->get();

        return View::render('tarea/create', [
            'proyectos' => $proyectos,
            'estados'   => Estado::all(),
            'usuarios'  => Usuario::all() // puedes limitarlo si quieres
        ]);
    }

    public function store()
    {
        $userId = $this->requireLogin();

        $proyectoId = (int) ($_POST['proyecto_id'] ?? 0);

        // Asegurarse de que el proyecto pertenece al usuario
        $proyecto = Proyecto::where('proyecto_id', $proyectoId)
            ->where('usuario_id', $userId)
            ->first();

        if (!$proyecto) {
            http_response_code(403);
            die("No puedes crear tareas en proyectos de otros usuarios.");
        }

        Tarea::create([
            'titulo'       => trim($_POST['titulo'] ?? ''),
            'descripcion'  => trim($_POST['descripcion'] ?? ''),
            'comentarios'  => trim($_POST['comentarios'] ?? ''),
            'proyecto_id'  => $proyectoId,
            'estado_id'    => (int) ($_POST['estado_id'] ?? 1),
            'usuario_id'   => (int) ($_POST['usuario_id'] ?? $userId),
            'fecha_limite' => $_POST['fecha_limite'] ?: null
        ]);

        header("Location: " . BASE_URL . "tarea");
        exit;
    }

    public function edit()
    {
        $userId = $this->requireLogin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $tarea = $this->findUserTaskOrFail($id, $userId);

        $proyectos = Proyecto::where('usuario_id', $userId)->get();

        return View::render('tarea/edit', [
            'tarea'     => $tarea,
            'proyectos' => $proyectos,
            'estados'   => Estado::all(),
            'usuarios'  => Usuario::all()
        ]);
    }

    public function update()
    {
        $userId = $this->requireLogin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $tarea = $this->findUserTaskOrFail($id, $userId);

        $proyectoId = (int) ($_POST['proyecto_id'] ?? 0);

        // Evitar mover la tarea a un proyecto ajeno
        $proyecto = Proyecto::where('proyecto_id', $proyectoId)
            ->where('usuario_id', $userId)
            ->first();

        if (!$proyecto) {
            http_response_code(403);
            die("No puedes mover esta tarea a un proyecto que no es tuyo.");
        }

        $tarea->titulo       = trim($_POST['titulo'] ?? '');
        $tarea->descripcion  = trim($_POST['descripcion'] ?? '');
        $tarea->comentarios  = trim($_POST['comentarios'] ?? '');
        $tarea->proyecto_id  = $proyectoId;
        $tarea->estado_id    = (int) ($_POST['estado_id'] ?? $tarea->estado_id);
        $tarea->usuario_id   = (int) ($_POST['usuario_id'] ?? $tarea->usuario_id);
        $tarea->fecha_limite = $_POST['fecha_limite'] ?: null;

        $tarea->save();

        header("Location: " . BASE_URL . "tarea");
        exit;
    }

    public function delete()
    {
        $userId = $this->requireLogin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $tarea = $this->findUserTaskOrFail($id, $userId);

        $tarea->delete();

        header("Location: " . BASE_URL . "tarea");
        exit;
    }
}
