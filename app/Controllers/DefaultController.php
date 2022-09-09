<?php

namespace App\Controllers;

use Services\AbstractController;
use Services\Routing\Route;

class DefaultController extends AbstractController
{
    /**
     * 
     */
    #[Route(path: '/', method: 'GET')]
    public function index(): string
    {
        return $this->view->render('home.html.twig');
    }
}
