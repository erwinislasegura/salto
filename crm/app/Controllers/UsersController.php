<?php
namespace CRM\Controllers;

use CRM\Core\Auth;
use CRM\Core\Controller;
use CRM\Models\User;

class UsersController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $this->view('users/index', ['title' => 'Usuarios CRM', 'users' => User::all()]);
    }

    public function create(): void
    {
        Auth::requireLogin();
        $this->view('users/form', ['title' => 'Nuevo usuario', 'user' => null]);
    }

    public function store(): void
    {
        Auth::requireLogin();
        User::create($this->payload(true));
        $this->redirect('users');
    }

    public function edit(): void
    {
        Auth::requireLogin();
        $user = User::find((int) ($_GET['id'] ?? 0));
        if (!$user) {
            $this->redirect('users');
        }
        $this->view('users/form', ['title' => 'Editar usuario', 'user' => $user]);
    }

    public function update(): void
    {
        Auth::requireLogin();
        User::update((int) ($_POST['id'] ?? 0), $this->payload(false));
        $this->redirect('users');
    }

    public function delete(): void
    {
        Auth::requireLogin();
        $current = Auth::user();
        $id = (int) ($_POST['id'] ?? 0);
        if ($current && $id !== (int) $current['id']) {
            User::delete($id);
        }
        $this->redirect('users');
    }

    private function payload(bool $passwordRequired): array
    {
        $password = $_POST['password'] ?? '';
        if ($passwordRequired && $password === '') {
            die('La contraseña es obligatoria para crear usuarios.');
        }

        return [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $password,
            'role' => in_array($_POST['role'] ?? 'editor', ['admin', 'editor'], true) ? $_POST['role'] : 'editor',
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];
    }
}
