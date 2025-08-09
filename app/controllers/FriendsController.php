<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Friends;

class FriendsController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) { header('Location:/login'); return; }
        $m=new Friends();
        $list=$m->friends((int)$_SESSION['user_id']);
        $reqs=$m->requests((int)$_SESSION['user_id']);
        $this->render('friends/index',['title'=>'Amis','friends'=>$list,'requests'=>$reqs]);
    }
    public function request(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $to=(int)($_POST['to']??0);
        $m=new Friends();
        $m->request((int)$_SESSION['user_id'],$to);
        $this->json(['ok'=>true]);
    }
    public function respond(): void
    {
        if (!isset($_SESSION['user_id'])) { $this->json(['error'=>'auth'],401); return; }
        $id=(int)($_POST['id']??0); $status=$_POST['status']??'accepted';
        $m=new Friends();
        $m->respond($id,(int)$_SESSION['user_id'],$status);
        $this->json(['ok'=>true]);
    }
}