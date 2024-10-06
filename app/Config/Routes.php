<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'login::index');
$routes->get('admin', 'Admin::index'); // Ganti 'AdminController::index' dengan controller dan method yang sesuai untuk halaman admin
$routes->get('pengguna', 'Pengguna::index'); // Ganti 'PenggunaController::index' dengan controller dan method yang sesuai untuk halaman pengguna


$routes->get('/admin/index', 'admin::index');

$routes->get('/akunPengguna/index', 'akunPengguna::index');
$routes->get('/akunPengguna/formtambah', 'akunPengguna::formtambah');
$routes->get('/akunPengguna/formedit/(:any)', 'akunPengguna::formedit/$1');

// $routes->get('/', 'Main::index');
$routes->get('email/formtambah', 'email::formtambah');

$routes->get('/email/hapus/(:any)', 'email::index');
$routes->delete('/email/hapus/(:any)', 'email::hapus/$1');

$routes->get('sendmail', 'bagikan::index'); // Sesuaikan rute dan nama controller




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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
