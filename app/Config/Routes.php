<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('inicio', 'Usuarios::index');
$routes->get('listar', 'Usuarios::listar');
$routes->get('crear', 'Usuarios::crear');
$routes->post('guardar', 'Usuarios::guardar');
$routes->get('borrar/(:num)', 'Usuarios::borrar/$1');
$routes->get('editar/(:num)', 'Usuarios::editar/$1');
$routes->post('actualizar', 'Usuarios::actualizar');
$routes->get('iniciosesion', 'Usuarios::iniciosesion');
$routes->post('ingresar', 'Usuarios::ingresar');
$routes->get('perfil', 'Usuarios::perfil');

$routes->get('exportExcel', 'ExportDocument::exportExcel');
$routes->get('exportWord', 'ExportDocument::ExportWord');
$routes->get('exportPdf', 'ExportDocument::exportPdf');

$routes->get('crearGaleria', 'Usuarios::crearGaleria');
$routes->post('guardarGaleria', 'Usuarios::guardarGaleria');
$routes->get('borrarGaleria/(:num)', 'Usuarios::borrarGaleria/$1');
