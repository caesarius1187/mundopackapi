<?php
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use Cake\Event\Event;
use Cake\Event\EventManager;

EventManager::instance()->on(
    UsersAuthComponent::EVENT_AFTER_LOGIN,
    ['priority' => 99], // set last in the priority queue in case you add more events to AFTER_LOGIN
    function (Event $event) {
        if ($event->data['user']['role'] === 'superuser') {
            return ['plugin' => null, 'controller' => 'Ordenesdepedidos', 'action' => 'index'];
        }
        if ($event->data['user']['role'] === 'operador') {
            return ['plugin' => null, 'controller' => 'Empleados', 'action' => 'dashboard'];
        }
        if ($event->data['user']['role'] === 'administativo') {
            return ['plugin' => null, 'controller' => 'Ordenesdetrabajos', 'action' => 'asignacion'];
        }
       

        // other roles will be redirected to the url configured at 'Auth.loginRedirect' in "src/config/users.php"
    }
);
?>