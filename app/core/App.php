<?php
// ... existing code ...
namespace App\\Core;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        $this->router->get('/', 'HomeController@index');
        $this->router->get('/login', 'AuthController@login');
        $this->router->post('/login', 'AuthController@doLogin');
        $this->router->get('/register', 'AuthController@register');
        $this->router->post('/register', 'AuthController@doRegister');
        $this->router->get('/logout', 'AuthController@logout');

        // Feed
        $this->router->get('/feed', 'FeedController@index');
        $this->router->post('/post/create', 'FeedController@create');
        $this->router->post('/post/react', 'FeedController@react');
        $this->router->post('/post/comment', 'FeedController@comment');

        // Video
        $this->router->get('/video', 'VideoController@index');
        $this->router->get('/video/upload', 'VideoController@upload');
        $this->router->post('/video/upload', 'VideoController@doUpload');
        $this->router->get('/video/watch', 'VideoController@watch');
        $this->router->post('/video/like', 'VideoController@like');
        $this->router->post('/video/comment', 'VideoController@comment');

        // Messaging
        $this->router->get('/messages', 'MessageController@index');
        $this->router->get('/messages/thread', 'MessageController@thread');
        $this->router->post('/messages/send', 'MessageController@send');
        $this->router->get('/status', 'MessageController@status');

        // Profile
        $this->router->get('/profile', 'ProfileController@index');
        $this->router->post('/profile/update', 'ProfileController@update');

        // API for notifications
        $this->router->get('/notifications', 'NotificationController@index');
        $this->router->post('/notifications/read', 'NotificationController@markRead');
    }

    public function run(): void
    {
        $this->router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}