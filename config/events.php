<?php
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use Cake\Event\Event;
use Cake\Event\EventManager;

EventManager::instance()->on(
    UsersAuthComponent::EVENT_AFTER_LOGIN,
    ['priority' => 99], // set last in the priority queue in case you add more events to AFTER_LOGIN
    function (Event $event) {
        if ($event->data['user']['role'] === 'superuser') {
            return ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'index'];
        }
        if ($event->data['user']['role'] === 'extrusor') {
            return ['plugin' => null, 'controller' => 'Extrusoras', 'action' => 'index'];
        }
        if ($event->data['user']['role'] === 'impresor') {
            return ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'index'];
        }
        if ($event->data['user']['role'] === 'cortador') {
            return ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'index'];
        }
        if ($event->data['user']['role'] === 'admin') {
            return ['plugin' => null, 'controller' => 'Clientes', 'action' => 'index'];
        }

        // other roles will be redirected to the url configured at 'Auth.loginRedirect' in "src/config/users.php"
    }
);
?>