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

        // Channels
        $this->router->get('/channel', 'ChannelController@index');
        $this->router->get('/channel/create', 'ChannelController@create');
        $this->router->post('/channel/create', 'ChannelController@store');
        $this->router->get('/channel/view', 'ChannelController@view');
        $this->router->post('/channel/subscribe', 'ChannelController@subscribe');

        // Playlists
        $this->router->get('/playlist', 'PlaylistController@index');
        $this->router->get('/playlist/create', 'PlaylistController@create');
        $this->router->post('/playlist/create', 'PlaylistController@store');
        $this->router->get('/playlist/view', 'PlaylistController@view');
        $this->router->post('/playlist/add', 'PlaylistController@addVideo');
        $this->router->post('/playlist/remove', 'PlaylistController@removeVideo');

        // Search
        $this->router->get('/search', 'SearchController@index');

        // Messaging
        $this->router->get('/messages', 'MessageController@index');
        $this->router->get('/messages/thread', 'MessageController@thread');
        $this->router->post('/messages/send', 'MessageController@send');
        $this->router->get('/status', 'MessageController@status');

        // Messaging Groups
        $this->router->get('/messages/groups', 'MessageGroupController@index');
        $this->router->get('/messages/groups/create', 'MessageGroupController@create');
        $this->router->post('/messages/groups/create', 'MessageGroupController@store');
        $this->router->get('/messages/groups/thread', 'MessageGroupController@thread');
        $this->router->post('/messages/groups/send', 'MessageGroupController@send');

        // Friends
        $this->router->get('/friends', 'FriendsController@index');
        $this->router->post('/friends/request', 'FriendsController@request');
        $this->router->post('/friends/respond', 'FriendsController@respond');

        // Profile
        $this->router->get('/profile', 'ProfileController@index');
        $this->router->post('/profile/update', 'ProfileController@update');

        // Pages
        $this->router->get('/pages', 'PageController@index');
        $this->router->get('/pages/create', 'PageController@create');
        $this->router->post('/pages/create', 'PageController@store');

        // Social Groups
        $this->router->get('/groups', 'SocialGroupController@index');
        $this->router->get('/groups/create', 'SocialGroupController@create');
        $this->router->post('/groups/create', 'SocialGroupController@store');

        // Events
        $this->router->get('/events', 'EventController@index');
        $this->router->get('/events/create', 'EventController@create');
        $this->router->post('/events/create', 'EventController@store');

        // Stories
        $this->router->get('/stories', 'StoryController@index');
        $this->router->get('/stories/create', 'StoryController@create');
        $this->router->post('/stories/create', 'StoryController@store');

        // Explorer
        $this->router->get('/explorer', 'ExplorerController@index');

        // API for notifications
        $this->router->get('/notifications', 'NotificationController@index');
        $this->router->post('/notifications/read', 'NotificationController@markRead');
    }

    public function run(): void
    {
        $this->router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}