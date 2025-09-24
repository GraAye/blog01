<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rutas de autenticación
$routes->get('/login', 'AuthController::login');
$routes->post('/doLogin', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');

// Dashboard protegido
$routes->get('/admin/dashboard', 'admin\DashboardController::index', ['filter' => 'auth']);

// Rutas de posts
$routes->get('/admin/newPost', 'admin\PostsController::create', ['filter' => 'auth']);
$routes->post('/admin/savePost', 'admin\PostsController::store', ['filter' => 'auth']);
$routes->get('/admin/posts/edit/(:num)', 'admin\PostsController::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/posts/update/(:num)', 'admin\PostsController::update/$1', ['filter' => 'auth']);
$routes->post('/admin/posts/delete/(:num)', 'admin\PostsController::delete/$1', ['filter' => 'auth']);

// Rutas de categorías
$routes->get('/categories', 'CategoryController::index');
$routes->post('categories/create', 'CategoryController::store');
$routes->post('categories/update/(:num)', 'CategoryController::update/$1');
$routes->post('categories/delete/(:num)', 'CategoryController::delete/$1');
