<?php

namespace Services;

use Faker\Factory;
use Services\Container\Container;

abstract class AbstractController
{
    protected ?Container $container = null;

    public function __construct(
        protected $view = null
    )
    {
        $this->faker = Factory::create('fr_FR');
        $this->container = App::get();

        if (isset($this->container['view']))
            $this->view = $this->container['view'];
    }
}