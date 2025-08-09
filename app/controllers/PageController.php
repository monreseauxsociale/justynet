<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\Page;

class PageController extends Controller
{
    public function index(): void
    {
        $m=new Page();
        $pages=$m->listAll();
        $this->render('pages/index',['title'=>'Pages','pages'=>$pages]);
    }
    public function create(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location:/login'); return; }
        $this->render('pages/create',['title'=>'Créer une page']);
    }
    public function store(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location:/login'); return; }
        $name=trim($_POST['name']??'');$desc=trim($_POST['description']??'');
        $m=new Page();$id=$m->create((int)$_SESSION['user_id'],$name,$desc);
        header('Location:/pages');
    }
}