<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;


class AuthController extends Controller
{
    public function login(): void
    {
        if(isset($_POST['email']) && isset($_POST['password'])){
            $this->procesar();
            return;
        }
        $this->view('auth/login', []);
    }

    public function register(): void
    {
        
    }
    public function procesar(): void
    {
        //usar el modelo User para validar el login
        //buscar usuario por email
        $usuario=Usuario::where('email',$_POST['email'])->first();
        if ($usuario && password_verify($_POST['password'], $usuario->password)) {
            // Credenciales correctas
            $_SESSION['user_id'] = $usuario->usuario_id;
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        } else {
            // Credenciales incorrectas
            $this->view('auth/login', [
                'error' => 'Email o contraseña incorrectos.'
            ]);
        }



    }


}
