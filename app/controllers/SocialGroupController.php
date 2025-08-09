<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\SocialGroup;

class SocialGroupController extends Controller
{
    public function index(): void
    {
        $m=new SocialGroup();
        $groups=$m->listAll();
        $this->render('groups/index',['title'=>'Groupes','groups'=>$groups]);
    }
    public function create(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $this->render('groups/create',['title'=>'Créer un groupe']);
    }
    public function store(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $name=trim($_POST['name']??'');$privacy=$_POST['privacy']??'public';
        $m=new SocialGroup();$m->create((int)$_SESSION['user_id'],$name,$privacy);
        header('Location:/groups');
    }
}