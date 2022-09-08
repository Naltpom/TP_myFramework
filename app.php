<?php

require_once __DIR__ . './vendor/autoload.php';

use Services\Container\Container;
use Services\Routing\Router;
use Services\Routing\Route;

use Symfony\Component\Yaml\Yaml;

$container = new Container();

$container['routes'] = Yaml::parse(file_get_contents(__DIR__ . '\\config\\routes.yaml'));
$container['router'] = function ($c) {
    $router = new Router;
    foreach ($c['routes'] as $route) {
        $router->addRoute(new Route(
            str_replace(
                '=', 
                ':', 
                str_replace(
                    ['[', ']'], 
                    '', 
                    http_build_query($route,'',', ')
                )
            )
        ));
    }

    return $router;
};

Services\App::set($container);
