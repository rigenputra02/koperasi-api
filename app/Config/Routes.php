<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('user', ['controller' => 'UserController']);
$routes->resource('simpanan', ['controller' => 'SimpananController']);
$routes->resource('shu', ['controller' => 'ShuController']);
$routes->resource('denda', ['controller' => 'DendaController']);
$routes->resource('laporan', ['controller' => 'LaporanController']);
$routes->resource('pupuk', ['controller' => 'InfoPupukController']);
$routes->resource('cicilan', ['controller' => 'CicilanController']);
$routes->resource('distribusi', ['controller' => 'DistribusiController']);


// $routes->get('user', 'UserController::index');
// $routes->get('user/(:num)', 'UserController::show/$1');
// $routes->post('user', 'UserController::create');
// $routes->put('user/(:num)', 'UserController::update/$1');
// $routes->delete('user/(:num)', 'UserController::delete/$1');


