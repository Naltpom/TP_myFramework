<?php

namespace App\Controllers;

use Services\AbstractController;
use Services\Routing\Route;
use Faker\Factory;

class BlogController extends AbstractController
{
    /**
     * Cette route permet de retourner la liste des blogs
     */
    #[Route(path: '/blogs', method: 'GET')]
    public function index(): string
    {
        $blogs = [];
        for ($i=0; $i < 50; $i++) { 
            $blogs[] = [
                'id' => $this->faker->numberBetween(1, 100),
                'title' => $this->faker->sentence(3),
                'author' => $this->faker->name(),
                'datePublished' => $this->faker->dateTime(),
                'content' => $this->faker->paragraph(4, true),
            ];
        }
        return $this->view->render('blogs.html.twig', ['blogs' => $blogs]);
    }

    /**
     * Cette route permet de retourner un blog
     * @param int $id - id of a speficif blog
     */
    #[Route(path: '/blogs/{id}', method: 'GET')]
    public function show(int $id): string
    {
        $blog = [
            'id' => $id,
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'datePublished' => $this->faker->dateTime(),
            'content' => $this->faker->paragraph(4, true),
        ];

        return $this->view->render('blog.html.twig', ['blog' => $blog]);
    }
}
