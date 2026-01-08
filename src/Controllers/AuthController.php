<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;

class AuthController extends Controller
{
    /* ============================
       LOGIN
    ============================ */
    public function login(): void
    {
        // Si envían el formulario, procesamos
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $this->procesarLogin();
            return;
        }

        // Si no, mostramos la vista
        $this->view('auth/login', []);
    }

    private function procesarLogin(): void
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $usuario = Usuario::where('email', $email)->first();

        if ($usuario && password_verify($password, $usuario->password)) {

            // Guardar sesión
            $_SESSION['user_id'] = $usuario->usuario_id;

            // Redirigir al dashboard
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        // Si falla
        $this->view('auth/login', [
            'error' => 'Email o contraseña incorrectos.'
        ]);
    }


    /* ============================
       REGISTER
    ============================ */
    public function register(): void
    {
        // Si envían el formulario
        if (!empty($_POST['email']) && !empty($_POST['nombre']) && !empty($_POST['password'])) {
            $this->procesarRegistro();
            return;
        }

        // Mostrar vista
        $this->view('auth/register', []);
    }

    private function procesarRegistro(): void
    {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        // Validaciones básicas
        if ($password !== $passwordConfirm) {
            $this->view('auth/register', [
                'error' => 'Las contraseñas no coinciden.'
            ]);
            return;
        }

        // Comprobar si el email ya existe
        if (Usuario::where('email', $email)->exists()) {
            $this->view('auth/register', [
                'error' => 'El email ya está registrado.'
            ]);
            return;
        }

        try {
            // Crear usuario
            $usuario = new Usuario();
            $usuario->nombre = $nombre;
            $usuario->email = $email;
            $usuario->password = password_hash($password, PASSWORD_BCRYPT);
            $usuario->save();

            // Redirigir al login
            header('Location: ' . BASE_URL . 'login');
            exit;

        } catch (\Exception $e) {
            $this->view('auth/register', [
                'error' => 'Error al registrar el usuario.'
            ]);
        }
    }


    /* ============================
       LOGOUT
    ============================ */
    public function logout(): void
    {
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
        exit;
    }
}
