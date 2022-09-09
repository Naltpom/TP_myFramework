<?php

namespace App\Controllers;

use Services\AbstractController;
use Services\Routing\Route;

class NotFoundController extends AbstractController
{
    /**
     * Cette route permet de retourner la liste des blogs
     */
    #[Route(path: '/404', methods: ['GET'])]
    public function index(): string
    {
        return $this->view->render('404.html.twig');
    }
}