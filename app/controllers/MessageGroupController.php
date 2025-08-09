<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\ChatGroup;
use App\\Models\\GroupMessage;

class MessageGroupController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location:/login'); return; }
        $model = new ChatGroup();
        $groups = $model->listByUser((int)$_SESSION['user_id']);
        $this->render('message/groups', ['title'=>'Groupes','groups'=>$groups]);
    }

    public function create(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location:/login'); return; }
        $this->render('message/group_create', ['title'=>'Créer un groupe']);
    }

    public function store(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location:/login'); return; }
        $name=trim($_POST['name']??'');
        $model=new ChatGroup();
        $id=$model->create((int)$_SESSION['user_id'],$name);
        header('Location:/messages/groups');
    }

    public function thread(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $gid=(int)($_GET['id']??0);
        $gm=new GroupMessage();
        $messages=$gm->getThread($gid);
        $this->json(['messages'=>$messages]);
    }

    public function send(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $gid=(int)($_POST['group_id']??0);
        $text=trim($_POST['text']??'');
        $gm=new GroupMessage();
        if($gid && $text!=='') $gm->send($gid,(int)$_SESSION['user_id'],$text);
        $this->json(['ok'=>true]);
    }
}