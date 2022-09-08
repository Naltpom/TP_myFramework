<?php

namespace App\Controllers;

use Services\AbstractController;
use Services\Routing\Route;

class CategoryController extends AbstractController
{
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
