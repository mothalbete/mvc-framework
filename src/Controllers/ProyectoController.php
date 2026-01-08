<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    public function index(): void
    {
        $proyectos = Proyecto::with('tareas.usuario', 'tareas.estado')->get();

        $this->view('proyecto/index', [
            'proyectos' => $proyectos
        ]);
    }

    public function create(): void
    {
        $this->view('proyecto/create');
    }

    public function store(): void
    {
        Proyecto::create([
            'titulo' => $_POST['titulo'],
            'descrion' => $_POST['descrion'],
            'comentarios' => $_POST['comentarios'],
            'usuario_id' => $_SESSION['user_id']
        ]);

        header("Location: " . BASE_URL . "proyecto");
        exit;
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("ID no proporcionado");
        }

        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            die("Proyecto no encontrado");
        }

        $this->view('proyecto/edit', [
            'proyecto' => $proyecto
        ]);
    }

    public function update(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("ID no proporcionado");
        }

        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            die("Proyecto no encontrado");
        }

        $proyecto->update([
            'titulo' => $_POST['titulo'],
            'descrion' => $_POST['descrion'],
            'comentarios' => $_POST['comentarios']
        ]);

        header("Location: " . BASE_URL . "proyecto");
        exit;
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("ID no proporcionado");
        }

        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            die("Proyecto no encontrado");
        }

        $proyecto->delete();

        header("Location: " . BASE_URL . "proyecto");
        exit;
    }
}
