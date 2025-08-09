<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Video;
use App\Models\Post;

class ExplorerController extends Controller
{
    public function index(): void
    {
        $v=new Video();$p=new Post();
        $videos=$v->getDiscover();
        $posts=$p->getFeed((int)($_SESSION['user_id']??0));
        $this->render('explorer/index',['title'=>'Explorer','videos'=>$videos,'posts'=>$posts]);
    }
}