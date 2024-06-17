<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create/category', name: 'category_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Category successfully created!');
            return $this->redirectToRoute('app_category');
        }


        return $this->render('category.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{category}/edit', name: 'category_edit')]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Category successfully updated!');
            return $this->redirectToRoute('app_category');
        }

        return $this->render('category.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    #[Route('/category/{category}/delete', name: 'category_delete')]
    public function delete(Category $category, EntityManagerInterface $entityManager): Response
    {

       $entityManager->remove($category);
       $entityManager->flush();

        return $this->redirectToRoute('app_category');
    }
}
