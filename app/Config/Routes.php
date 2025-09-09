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

// Mobile API routes
$routes->post('api/login', 'Api\Auth::login');
$routes->post('api/register', 'Api\Auth::register');


// Protected routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    
    // Users
    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
    $routes->get('users', 'Users::index');
    
    // Logs
    $routes->get('activity_log', 'Logs::index');
    
    // Disease
    $routes->get('/disease', 'Disease::index');
    $routes->post('disease/store', 'Disease::store'); // 👈 handles form submission


    // Images
    $routes->get('images', 'Images::index');          // Upload form page
    $routes->post('images/upload', 'Images::upload'); // Handle upload
    $routes->get('images/list', 'Images::list');      // Show uploaded list

    // Diagnosis (View Only)
    $routes->get('diagnosis', 'Diagnosis::index');           // list all
});