<?php

namespace App\Controllers;

use Services\AbstractController;
use Services\Routing\Route;

class DefaultController extends AbstractController
{
    /**
     * Cette route permet de retourner la liste des blogs
     */
    #[Route(path: '/', method: 'GET')]
    public function index(): string
    {
        return $this->view->render('home.html.twig');
    }
}