<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Client\Home\HomeController::index', ['as' => 'client_home']);

$routes->group('registro', function ($routes) {
    $routes->get('/', 'Register\RegisterController::index', ['as' => 'register_index']);
});

$routes->group('user', function ($routes) {
    $routes->post('new', 'Client\User\UserController::new', ['as' => 'client_user_new']);
});

$routes->group('login', function ($routes) {
    $routes->match(['get', 'post'], '/', 'Login\LoginController::login', ['as' => 'login']);
});

$routes->group('logout', function ($routes) {
    $routes->get('/', 'Login\LoginController::logout', ['as' => 'logout']);
});

$routes->group('profile', function ($routes) {
    $routes->match(['get', 'post'], 'edit', 'Client\Profile\ProfileController::edit', ['as' => 'client_profile']);
});

$routes->group('admin', ['filter' => 'role:["ROLE_USER"],["ROLE_ADMIN"],["ROLE_SUPERADMIN"]'], function ($routes) {
    $routes->get('/', 'AdminPanel\HomeController::index', ['as' => 'admin_panel_home_index']);

    $routes->group('user', function ($routes) {
        $routes->get('/', 'AdminPanel\UserController::index', ['as' => 'admin_panel_user_index']);
        $routes->get('(:num)', 'AdminPanel\UserController::show/$1', ['as' => 'admin_panel_user_show']);
        $routes->match(['get', 'post'], 'new', 'AdminPanel\UserController::new', ['as' => 'admin_panel_user_new']);
        $routes->match(['get', 'post'], '(:num)/edit', 'AdminPanel\UserController::edit/$1', ['as' => 'admin_panel_user_edit']);
        $routes->get('delete', 'AdminPanel\UserController::delete', ['as' => 'admin_panel_user_delete']);
    });

    $routes->group('video', function ($routes) {
        $routes->get('/', 'AdminPanel\VideoController::index', ['as' => 'admin_panel_video_index']);
        $routes->get('(:num)', 'AdminPanel\VideoController::show/$1', ['as' => 'admin_panel_video_show']);
        $routes->match(['get', 'post'], 'new', 'AdminPanel\VideoController::new', ['as' => 'admin_panel_video_new']);
        $routes->match(['get', 'post'], '(:num)/edit', 'AdminPanel\VideoController::edit/$1', ['as' => 'admin_panel_video_edit']);
        $routes->get('delete', 'AdminPanel\VideoController::delete', ['as' => 'admin_panel_video_delete']);
    });

    $routes->group('profile', function ($routes) {
        $routes->match(['get', 'post'], 'edit', 'AdminPanel\ProfileController::edit', ['as' => 'admin_panel_profile_edit']);
    });
});

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
