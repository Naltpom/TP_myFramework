<?php

namespace Services\Routing;

class Route
{
    private string $controller;
    private string $action;

    public function __construct(
        private ?string $path = null,
        private ?string $pattern = null,
        private array $methods = [],
        ?string $connect = null,
        private $params = null
    ) {
        $this->setConnect($connect);
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setConnect(string $connect)
    {
        $c = explode(':', $connect);
        if (count($c) != 2) {
            throw new \RuntimeException('Bad syntax connect.');
        }

        list($this->controller, $this->action) = $c;
    }

    public function getConnect(): ?string
    {
        return $this->connect;
    }

    public function getParams()
    {
        return $this->params;
    }
    
    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function isMatch($url, $verb)
    {
        if (preg_match('/^' . $this->pattern . '$/', $url, $m)) {
            $this->setParams($m);

            return true;
        } else {
            return false;
        }
    }

    public function setParamsREST($m)
    {
        $this->params['id'] = (empty($m['id'])) ?: $m['id'];

        if ($this->verb == 'GET') {
            $action = (!empty($m['create'])) ? 'create' : (!empty($m['edit']) ? 'edit' : ((!empty($m['id']) ? 'show' : 'index')));

            $this->routeName = $action;
        }

        if ($this->verb == 'POST') {
            $this->routeName = 'store';
        }

        if ($this->verb == 'PUT' || $this->verb == 'PATCH') {
            $this->routeName = 'update';
        }

        if ($this->verb == 'DELETE') {
            $this->routeName = 'destroy';
        }

    }
    
    public function setParams($m)
    {
        if (empty($this->params)) {
            return;
        }

        $params = explode(',', (string) $this->params);
        $this->params = [];
        foreach ($params as $p) {
            $this->params[$p] = $m[$p];
        }
    }
}