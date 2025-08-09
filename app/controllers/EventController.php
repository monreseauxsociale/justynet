<?php
// ... existing code ...
namespace App\\Controllers;

use App\\Core\\Controller;
use App\\Models\\EventModel;

class EventController extends Controller
{
    public function index(): void
    {
        $m=new EventModel();
        $events=$m->listUpcoming();
        $this->render('events/index',['title'=>'Événements','events'=>$events]);
    }
    public function create(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $this->render('events/create',['title'=>'Créer un événement']);
    }
    public function store(): void
    {
        if(!isset($_SESSION['user_id'])){header('Location:/login');return;}
        $name=trim($_POST['name']??'');$location=trim($_POST['location']??'');$start=$_POST['start_at']??'';$desc=trim($_POST['description']??'');
        $m=new EventModel();$m->create((int)$_SESSION['user_id'],$name,$location,$start,$desc);
        header('Location:/events');
    }
}