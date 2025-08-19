<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->get('/auth/registration', 'Auth::registration');
$routes->post('/auth/create', 'Auth::create');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');
