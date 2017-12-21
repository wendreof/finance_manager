<?php
/**
 * Created by PhpStorm.
 * User: wlf
 * Date: 19/12/17
 * Time: 22:59
 */

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use WLFin\Application;
use WLFin\Plugins\RoutePlugin;
use WLFin\Plugins\ViewPlugin;
use WLFin\ServiceContainer;
use Zend\Diactoros\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

$app->get('/{name}', function(ServerRequestInterface $request) use ($app) {
   $view = $app->service('view.renderer');
   return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});

$app->get('/home/{name}/{id}', function(ServerRequestInterface $request) {
    $response = new Response();
    $response->getBody()->write("Response with diactoros emitter");
    return $response;
});

$app->start();
