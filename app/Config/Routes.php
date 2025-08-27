<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');

$routes->get('/auth/registration', 'Auth::registration');
$routes->post('/auth/create', 'Auth::create');

$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/logout', 'Auth::logout');

$routes->get('/images', 'Images::index');
$routes->post('/images/upload', 'Images::upload');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('users', 'Users::index');
    $routes->get('logs', 'Logs::index');
    $routes->get('disease', 'Disease::index');
    // add more protected routes here
});
