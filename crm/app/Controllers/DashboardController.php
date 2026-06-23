<?php
namespace CRM\Controllers;

use CRM\Core\Auth;
use CRM\Core\Controller;
use CRM\Models\User;

class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $this->view('dashboard/index', [
            'title' => 'Panel CRM',
            'userCount' => User::count(),
            'currentUser' => Auth::user(),
        ]);
    }
}
