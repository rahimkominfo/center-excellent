<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Dashboard routes
$routes->group('dashboard', static function ($routes) {
    $routes->get('/', 'Dashboard::index');
    
    $routes->get('kontrak_ppk', 'Dashboard::kontrak_ppk');
    
    $routes->get('penilaian_ppk', 'Dashboard::penilaian_ppk');
    $routes->post('penilaian_ppk/store', 'Dashboard::penilaian_ppk_store');
    
    $routes->get('addendum', 'Dashboard::addendum');
    $routes->post('addendum/store', 'Dashboard::addendum_store');
    $routes->get('addendum/delete/(:num)', 'Dashboard::addendum_delete/$1');
    
    $routes->get('sp2d', 'Dashboard::sp2d');
    $routes->post('sp2d/store', 'Dashboard::sp2d_store');
    $routes->get('sp2d/delete/(:num)', 'Dashboard::sp2d_delete/$1');
    
    $routes->get('form_edit_kontrak', 'Dashboard::form_edit_kontrak');
    $routes->post('form_edit_kontrak/update', 'Dashboard::form_edit_kontrak_update');
    
    $routes->get('form_edit_paket', 'Dashboard::form_edit_paket');
    $routes->post('form_edit_paket/update', 'Dashboard::form_edit_paket_update');
    
    $routes->get('lap_monitoring', 'Dashboard::lap_monitoring');
    $routes->get('lap_tepra', 'Dashboard::lap_tepra');
});

// Kontrak routes
$routes->group('kontrak', static function ($routes) {
    $routes->get('/', 'Kontrak::index');
    $routes->post('store', 'Kontrak::store');
    $routes->get('delete/(:num)', 'Kontrak::delete/$1');
    
    $routes->get('paket', 'Kontrak::paket');
    $routes->post('paket/store', 'Kontrak::paket_store');
    $routes->get('paket/delete/(:num)', 'Kontrak::paket_delete/$1');

    $routes->get('ppk', 'Kontrak::ppk');
    $routes->post('ppk/store', 'Kontrak::ppk_store');
    $routes->get('ppk/delete/(:num)', 'Kontrak::ppk_delete/$1');
});

// Penilaian routes
$routes->group('penilaian', static function ($routes) {
    $routes->get('/', 'Penilaian::index');
    $routes->get('aspek_kinerja', 'Penilaian::aspek_kinerja');
    $routes->post('aspek_kinerja/store', 'Penilaian::aspek_store');
    $routes->get('aspek_kinerja/delete/(:num)', 'Penilaian::aspek_delete/$1');
    $routes->post('aspek_kinerja/update_bobot', 'Penilaian::aspek_update_bobot');
    
    $routes->get('indikator_kinerja', 'Penilaian::indikator_kinerja');
    $routes->post('indikator_kinerja/store', 'Penilaian::indikator_store');
    $routes->get('indikator_kinerja/delete/(:num)', 'Penilaian::indikator_delete/$1');
    $routes->post('indikator_kinerja/update_bobot', 'Penilaian::indikator_update_bobot');
});
