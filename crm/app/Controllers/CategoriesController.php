<?php
namespace CRM\Controllers;

use CRM\Core\Auth;
use CRM\Core\Controller;
use CRM\Models\Category;

class CategoriesController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $this->view('categories/index', ['title' => 'Categorías', 'categories' => Category::all()]);
    }

    public function create(): void
    {
        Auth::requireLogin();
        $this->view('categories/form', ['title' => 'Nueva categoría', 'category' => null]);
    }

    public function store(): void
    {
        Auth::requireLogin();
        $data = $_POST;
        $data['hero_image'] = $this->imagePath('hero_image_file', $data['hero_image'] ?? '');
        Category::create($data);
        $this->redirect('categories');
    }

    public function edit(): void
    {
        Auth::requireLogin();
        $category = Category::find((int) ($_GET['id'] ?? 0));
        if (!$category) {
            $this->redirect('categories');
        }
        $this->view('categories/form', ['title' => 'Editar categoría', 'category' => $category]);
    }

    public function update(): void
    {
        Auth::requireLogin();
        $data = $_POST;
        $data['hero_image'] = $this->imagePath('hero_image_file', $data['hero_image'] ?? '');
        Category::update((int) ($_POST['id'] ?? 0), $data);
        $this->redirect('categories');
    }

    public function delete(): void
    {
        Auth::requireLogin();
        Category::delete((int) ($_POST['id'] ?? 0));
        $this->redirect('categories');
    }
}
