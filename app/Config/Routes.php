<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Home
$routes->get('/', 'Home::index');

// Registration
$routes->get('/register', 'Registration::index');   // show form
$routes->post('/register', 'Registration::store'); // handle submission

// Login / Auth
$routes->get('/login', 'Auth::login');             // show form
$routes->post('/login', 'Auth::authenticate');    // submit login
$routes->get('/logout', 'Auth::logout');          // logout

// Protected routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('users', 'Users::index');
    $routes->get('logs', 'Logs::index');
    $routes->get('disease', 'Disease::index');
    $routes->get('images', 'Images::index');
    $routes->post('images/upload', 'Images::upload');
});
