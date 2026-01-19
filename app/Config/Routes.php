<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Home
$routes->get('/', 'Home::index');

// Registration
$routes->get('/registration', 'Registration::index');
$routes->post('/registration', 'Registration::store');

// Login / Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

// Mobile API routes (NO AUTH REQUIRED)
$routes->post('api/login', 'Api\Auth::login');
$routes->post('api/register', 'Api\Auth::register');

// Test disease routes WITHOUT auth filter (TEMPORARY - for debugging)
$routes->get('api/diseases', 'Api\Diseases::index');
$routes->get('api/diseases/(:num)', 'Api\Diseases::show/$1');

// Test route without auth filter first
$routes->get('api/diseases/test', function() {
    return "Diseases route is working!";
});

// Mobile API routes (AUTH REQUIRED - using filter)
$routes->group('api', ['filter' => 'apiauth'], function($routes) {
    // Stats
    $routes->get('stats', 'Api\Stats::index');

    // Pests
    $routes->get('pests', 'Api\Pests::index');           
    $routes->get('pests/(:num)', 'Api\Pests::show/$1');  

    // Diseases (NEW)
    $routes->get('diseases', 'Api\Diseases::index');
    $routes->get('diseases/(:num)', 'Api\Diseases::show/$1');

    // User/Profile
    $routes->get('user/profile', 'Api\Profile::index');
    $routes->post('user/profile/change-password', 'Api\Profile::changePassword');
    $routes->post('user/update', 'Api\User::updateProfile');
    
    // Diagnosis
    $routes->post('diagnosis/upload', 'Api\Diagnosis::upload');
    $routes->get('diagnosis/history', 'Api\Diagnosis::history');
    
    // Feedback
    $routes->post('feedback', 'Api\Feedback::create');
    $routes->get('feedback', 'Api\Feedback::index');
    $routes->get('feedback/user', 'Api\Feedback::user');
    
    // Logout
    $routes->post('logout', 'Api\Auth::logout');
});

// Prediction API (if you're still using this)
$routes->group('api/prediction', ['namespace' => 'App\Controllers\API'], function($routes) {
    $routes->post('save', 'Prediction::save');
    $routes->get('disease/(:num)', 'Prediction::get_disease/$1');
    $routes->get('diseases', 'Prediction::get_all_diseases');
});

// Protected web routes (Admin Dashboard)
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
    $routes->post('disease/store', 'Disease::store');

    // Images
    $routes->get('images', 'Images::index');
    $routes->post('images/upload', 'Images::upload');
    $routes->get('images/list', 'Images::list');

    // Diagnosis (View Only - Web Dashboard)
    $routes->get('diagnosis', 'Diagnosis::index');
});