<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// RS Rujukan
$routes->get('/rs_rujukan', 'RsRujukan::index', ['filter' => 'role:admin']);
$routes->get('/rs_rujukan/ambildata', 'RsRujukan::ambildata', ['filter' => 'role:admin']);
$routes->get('/rs_rujukan/formtambah', 'RsRujukan::formtambah', ['filter' => 'role:admin']);
$routes->post('/rs_rujukan/simpandata', 'RsRujukan::simpandata', ['filter' => 'role:admin']);
$routes->post('/rs_rujukan/formedit', 'RsRujukan::formedit', ['filter' => 'role:admin']);
$routes->post('/rs_rujukan/updatedata', 'RsRujukan::updatedata', ['filter' => 'role:admin']);
$routes->post('/rs_rujukan/hapus', 'RsRujukan::hapus', ['filter' => 'role:admin']);

// Registrasi Vakin
$routes->get('/reg_vaksin', 'RegistrasiVaksin::index', ['filter' => 'role:admin']);
$routes->get('/reg_vaksin/ambildata', 'RegistrasiVaksin::ambildata', ['filter' => 'role:admin']);
$routes->get('/reg_vaksin/formtambah', 'RegistrasiVaksin::formtambah', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/simpandata', 'RegistrasiVaksin::simpandata', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/hapus', 'RegistrasiVaksin::hapus', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/get_user', 'RegistrasiVaksin::getUser', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/formProses/(:num)', 'RegistrasiVaksin::formProses/$1', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/updateProses', 'RegistrasiVaksin::updateProses', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/formSelesai/(:num)', 'RegistrasiVaksin::formSelesai/$1', ['filter' => 'role:admin']);
$routes->post('/reg_vaksin/updateSelesai', 'RegistrasiVaksin::updateSelesai', ['filter' => 'role:admin']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
