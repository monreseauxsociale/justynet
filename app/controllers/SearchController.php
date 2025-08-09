<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Video;
use App\Models\Channel;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');
        $videoModel = new Video();
        $channelModel = new Channel();
        $postModel = new Post();
        $videos = $q? $videoModel->search($q):[];
        $channels = $q? $channelModel->search($q):[];
        $posts = $q? $postModel->search($q):[];
        $this->render('search/index', ['title'=>'Recherche','q'=>$q,'videos'=>$videos,'channels'=>$channels,'posts'=>$posts]);
    }
}