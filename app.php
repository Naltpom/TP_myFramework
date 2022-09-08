<?php

require_once __DIR__ . './vendor/autoload.php';

use Services\Container\Container;
use Services\Dispatcher;
use Services\Request;
use Services\Routing\Router;
use Services\Routing\Route;
use Symfony\Component\Yaml\Yaml;

$container = new Container();

$container['routes'] = Yaml::parse(file_get_contents(__DIR__ . '\\config\\routes.yaml'));
$container['router'] = function ($c) {
    $router = new Router;
    foreach ($c['routes'] as $route) {
        $router->addRoute(new Route(
            path: $route['path'] ?? null,
            pattern: $route['pattern'] ?? null,
            methods: $route['methods'] ?? [],
            connect: $route['connect'] ?? null,
            params: $route['params'] ?? null,
        ));
    }

    return $router;
};

$loader = new Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);

$container['view'] = new Twig\Environment($loader);

Services\App::set($container);
$dispatcher = new Dispatcher(new Request());