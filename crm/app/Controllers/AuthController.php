<?php
namespace CRM\Controllers;

use CRM\Core\Auth;
use CRM\Core\Controller;

class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect();
        }

        $this->view('auth/login', ['title' => 'Acceso CRM', 'compact' => true]);
    }

    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth', 'login');
        }

        if (Auth::attempt(trim($_POST['email'] ?? ''), $_POST['password'] ?? '')) {
            $this->redirect();
        }

        $this->view('auth/login', [
            'title' => 'Acceso CRM',
            'compact' => true,
            'error' => 'Credenciales inválidas o usuario inactivo.',
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('auth', 'login');
    }
}
