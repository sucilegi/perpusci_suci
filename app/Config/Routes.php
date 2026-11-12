<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/dashboard','Dashboard::index');
$routes->get('/buku','Book::index');
$routes->get('/buku', 'Book::index');
$routes->get('/buku/tambah', 'Book::create');
$routes->post('/buku', 'Book::store');
$routes->get('/anggota','Member::index');
