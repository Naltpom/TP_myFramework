<?php

require_once __DIR__ . './vendor/autoload.php';

use Services\Routing\Route;
use Services\Routing\Router;

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


dd($router);


