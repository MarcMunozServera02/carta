<?php

use IAW\Projecte\Container;
use IAW\Projecte\Controller\CheckLoginController;
use IAW\Projecte\Controller\CheckRegistroController;
use IAW\Projecte\Controller\DashBoardController;
use IAW\Projecte\Controller\LoginController;
use IAW\Projecte\Controller\LogoutController;
use IAW\Projecte\Controller\VerCorreoController;
use IAW\Projecte\Controller\VerUsuariosController;
use IAW\Projecte\Controller\RegistroController;
use IAW\Projecte\DataBase\Connection;
use IAW\Projecte\View\NotFoundView;

session_start();
define( "APP_PATH", dirname( __DIR__, 2 ) );

require APP_PATH . '/vendor/autoload.php';

Container::service()->setConnection( new Connection() );

$dispatcher = FastRoute\simpleDispatcher( function ( FastRoute\RouteCollector $r ) {
    if ( isset( $_SESSION['usuario_id'] ) ) {
        $r->addRoute( 'GET', '/', DashBoardController::class );
    } else {
        $r->addRoute( 'GET', '/', LoginController::class );
    }
    $r->addRoute( 'GET', '/login', LoginController::class );
    $r->addRoute( 'GET', '/logout', LogoutController::class );
    $r->addRoute( 'POST', '/checkLogin', CheckLoginController::class );
    $r->addRoute( 'GET', '/dashboard', DashBoardController::class );
    $r->addRoute( 'GET', '/vercorreo', VerCorreoController::class );
    
    if($_SESSION['es_administrador']=='S'){
        $r->addRoute( 'GET', '/registro', RegistroController::class );
        $r->addRoute( 'GET', '/verusuarios', VerUsuariosController::class );
        $r->addRoute( 'POST', '/checkregistro', CheckRegistroController::class );
    }
} );

$uri = rawurldecode( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );
$uri = $uri == '/' ? $uri : preg_replace( '/\/$/', '', $uri );

$routeInfo = $dispatcher->dispatch( $_SERVER['REQUEST_METHOD'], $uri );
switch ( $routeInfo[0] ) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        ( new NotFoundView( '404 - La pagina que buscas no existe' ) )->render();
        break;
    
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 - no permitido";
        print_r( $routeInfo );
        break;
    
    case FastRoute\Dispatcher::FOUND:
        call_user_func_array( new $routeInfo[1], $routeInfo[2] );
        break;
}