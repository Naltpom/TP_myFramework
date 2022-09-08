<?php

namespace Services\Routing;

class Router implements \Countable
{
    protected $routes;

    public function __construct()
    {
        $this->routes = new \SplObjectStorage;
    }

    public function addRoute(Route $route)
    {
        $this->routes->attach($route);
    }

    public function getRoute($url, $verb = 'get')
    {
        foreach ($this->routes as $route) {
            if ($route->isMatch($url, $verb)) {
                return $route;
            }
        }

        throw new \RuntimeException("bad route exception, getRoute");
    }

    public function count(): int
    {
        return count($this->routes);
    }

    protected function isSameRoute($name)
    {
        foreach ($this->routes as $route) {
            if ($route->getConnect() == $name) {
                return true;
            }
        }

        return false;
    }
}