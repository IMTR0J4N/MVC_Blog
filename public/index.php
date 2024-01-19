<?php

require '../vendor/autoload.php';

use Blog\Helper;
use Blog\Router;

session_start();

$Router = new Router($_SERVER['REQUEST_URI']);

$Router->get('/', 'PostsController@index');

$Router->get('/auth/login', 'AuthController@login');
$Router->get('/auth/register', 'AuthController@register');

$Router->post('/auth/login', 'AuthController@doLogin');
$Router->post('/auth/register', 'AuthController@doRegister');

try {
    $Router->run();
} catch (Exception $e) {
    throw new Error($e);
}