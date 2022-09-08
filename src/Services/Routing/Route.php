<?php

namespace Services\Routing;

class Route
{
    public function __construct(
        private ?string $path = null,
        private ?string $pattern = null,
        private array $methods = [],
        private ?string $connect = null,
        private array $params = []
    ) {
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

    public function getConnect(): ?string
    {
        return $this->connect;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}