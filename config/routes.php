<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Weeks', 'action' => 'index']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/week/:id', ['controller' => 'Weeks', 'action' => 'view'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/week/create', ['controller' => 'Weeks', 'action' => 'add']);
    $routes->connect('/week/update/:id', ['controller' => 'Weeks', 'action' => 'edit'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/week/shoppingList/:id', ['controller' => 'Weeks', 'action' => 'shoppingList'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/week/remove/:id', ['controller' => 'Weeks', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/day/shoppingList/:dayId/:weekId', ['controller' => 'Days', 'action' => 'shoppingList'], ['dayId' => '\d+', 'weekId' => '\d+', 'pass' => ['dayId', 'weekId']]);
    $routes->connect('/day/create/:weekId', ['controller' => 'Days', 'action' => 'add'], ['weekId' => '\d+', 'pass' => ['weekId']]);
    $routes->connect('/day/update/:dayId/:weekId', ['controller' => 'Days', 'action' => 'edit'], ['dayId' => '\d+', 'weekId' => '\d+', 'pass' => ['dayId', 'weekId']]);
    $routes->connect('/day/:id', ['controller' => 'Days', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/dishes', ['controller' => 'Dishes', 'action' => 'index']);
    $routes->connect('/dish/:id', ['controller' => 'Dishes', 'action' => 'view'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/dishes/create', ['controller' => 'Dishes', 'action' => 'add']);
    $routes->connect('/dishes/create/:id', ['controller' => 'Dishes', 'action' => 'add'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/dish/update/:id', ['controller' => 'Dishes', 'action' => 'edit'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/dish/remove/:id', ['controller' => 'Dishes', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/ingredients', ['controller' => 'Ingredients', 'action' => 'index']);
    $routes->connect('/meal/create/:dayId', ['controller' => 'Meals', 'action' => 'add'], ['dayId' => '\d+', 'pass' => ['dayId']]);
    $routes->connect('/meal/:id', ['controller' => 'Meals', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
    //$routes->connect('/*', ['controller' => 'Weeks', 'action' => 'index']);
    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
