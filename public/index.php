<?php

Define('APP',realpath('../app'));

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Task', 'action' => 'index']);
$router->add('task/add', ['controller' => 'Task', 'action' => 'add']);
$router->add('task/view', ['controller' => 'Task', 'action' => 'view']);
$router->add('task/preview', ['controller' => 'Task', 'action' => 'preview']);
$router->add('admin/index', ['controller' => 'Admin', 'action' => 'index']);
$router->add('admin/view', ['controller' => 'Admin', 'action' => 'view']);
$router->add('admin/task/view', ['controller' => 'Admin', 'action' => 'view']);
$router->add('admin/login', ['controller' => 'Admin', 'action' => 'login']);
$router->add('admin/logout', ['controller' => 'Admin', 'action' => 'logout']);

$router->dispatch($_SERVER['QUERY_STRING']);
