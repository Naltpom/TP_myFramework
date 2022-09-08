<?php

namespace App\Controller;

use Services\Controller\AbstractController;
use Services\Routing\Route;

class BlogController extends AbstractController
{
    /**
     * Cette route permet de retourner la liste des blogs
     */
    #[Route(path: '/blog', method: 'GET')]
    public function index(): array
    {
        return [];
    }

    /**
     * Cette route permet de retourner un blog
     * @param int $id - id of a speficif blog
     */
    #[Route(path: '/blog/{id}', method: 'GET')]
    public function show(int $id): array
    {
        return [];
    }
}
