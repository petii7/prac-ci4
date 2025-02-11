<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/mapas', 'Mapas::mostrarMapas');
$routes->get('/mapas/inferno', 'Mapas::inferno');

