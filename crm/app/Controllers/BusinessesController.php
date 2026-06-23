<?php
namespace CRM\Controllers;

use CRM\Core\Auth;
use CRM\Core\Controller;
use CRM\Models\Business;
use CRM\Models\Category;

class BusinessesController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $this->view('businesses/index', ['title' => 'Comercios', 'businesses' => Business::all()]);
    }

    public function create(): void
    {
        Auth::requireLogin();
        $this->view('businesses/form', ['title' => 'Nuevo comercio', 'business' => null, 'categories' => Category::all(true)]);
    }

    public function store(): void
    {
        Auth::requireLogin();
        $data = $_POST;
        $data['image'] = $this->imagePath('image_file', $data['image'] ?? '');
        Business::create($data);
        $this->redirect('businesses');
    }

    public function edit(): void
    {
        Auth::requireLogin();
        $business = Business::find((int) ($_GET['id'] ?? 0));
        if (!$business) {
            $this->redirect('businesses');
        }
        $this->view('businesses/form', ['title' => 'Editar comercio', 'business' => $business, 'categories' => Category::all(true)]);
    }

    public function update(): void
    {
        Auth::requireLogin();
        $data = $_POST;
        $data['image'] = $this->imagePath('image_file', $data['image'] ?? '');
        Business::update((int) ($_POST['id'] ?? 0), $data);
        $this->redirect('businesses');
    }

    public function delete(): void
    {
        Auth::requireLogin();
        Business::delete((int) ($_POST['id'] ?? 0));
        $this->redirect('businesses');
    }
}
