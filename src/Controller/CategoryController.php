<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{category}', name: 'app_genre')]
    public function category(EntityManagerInterface $entityManager, $category): Response
    {
        //todo: this is for linking to a page for all games that have the tag/genre you click on
        $genre = $entityManager->getRepository(Category::class)->find($category);
        return $this->render('category/genre.html.twig', [
            'genre' => $genre,
        ]);
    }

    #[Route('create/{category}', name: 'app_category_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        
        $category = new Category();
        $entityManager->persist($category);
        $entityManager->flush();
        return $this->render('create.html.twig', [
            'category' => $category,
        ]);
    }
}
