<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Story;

class StoryController extends Controller
{
    public function index(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $m=new Story();
        $stories=$m->listActive();
        $this->render('stories/index',['title'=>'Statuts','stories'=>$stories]);
    }
    public function create(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $this->render('stories/create',['title'=>'Nouveau statut']);
    }
    public function store(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $kind=$_POST['kind']??'text';
        $text=trim($_POST['text']??'');
        $path=null;
        if(isset($_FILES['media']) && $_FILES['media']['error']===UPLOAD_ERR_OK){
            $ext=pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
            $name=uniqid('story_').'.'.$ext;
            $dest=__DIR__.'/../../public/uploads/images/'.$name;
            move_uploaded_file($_FILES['media']['tmp_name'],$dest);
            $path='/uploads/images/'.$name;
        }
        $m=new Story();
        $m->create((int)$_SESSION['user_id'],$kind,$text,$path);
        header('Location:/stories');
    }
}