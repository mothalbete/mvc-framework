<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Usuario;
use Core\View;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return View::render('auth/login');
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario || !password_verify($password, $usuario->password)) {
            return View::render('auth/login', [
                'error' => 'Credenciales incorrectas'
            ]);
        }

        $_SESSION['user_id'] = $usuario->usuario_id;

        header("Location: " . BASE_URL . "home");
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return View::render('auth/register');
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm = trim($_POST['password_confirm'] ?? '');

        if ($password !== $confirm) {
            return View::render('auth/register', [
                'error' => 'Las contraseñas no coinciden'
            ]);
        }

        if (Usuario::where('email', $email)->exists()) {
            return View::render('auth/register', [
                'error' => 'El email ya está registrado'
            ]);
        }

        Usuario::create([
            'nombre' => $nombre,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Cuenta creada correctamente. Ya puedes iniciar sesión.'
        ];

        header("Location: " . BASE_URL . "login");
        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "login");
        exit;
    }
}
