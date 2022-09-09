<?php

require_once __DIR__ . './vendor/autoload.php';

use Services\Container\Container;
use Services\Dispatcher;
use Services\Routing\Router;
use Services\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

$container = new Container();

$container['routes'] = Yaml::parse(file_get_contents(__DIR__ . '\\config\\routes.yaml'));
$container['router'] = function ($c) {
    $router = new Router;
    foreach(scandir('./app/Controllers') as $file){
        if (!str_ends_with($file, 'Controller.php')) {
            continue;
        }
        $file = str_replace('.php', '', $file);
        $namespace = "App\\Controllers\\$file";
        $reflection = new \ReflectionClass($namespace);
    
        foreach ($reflection->getMethods() as $reflectionMethods) {
            $methodsAttributes = $reflectionMethods->getAttributes(Route::class);
            foreach ($methodsAttributes as $attributes) {
                $arguments = $attributes->getArguments();
                $router->addRoute(new Route(
                    path: $arguments['path'] ?? null,
                    pattern: $arguments['pattern'] ?? null,
                    methods: $arguments['methods'] ?? [],
                    connect: $reflection->getName() . ':' . $reflectionMethods->getName(),
                    params: $arguments['params'] ?? null,
                ));
            }
        }
    }

    return $router;
};
$loader = new Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);

$container['view'] = new Twig\Environment($loader);

Services\App::set($container);
$dispatcher = new Dispatcher(Request::createFromGlobals());