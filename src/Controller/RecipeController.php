<?php

namespace App\Controller;

use App\Entity\FilterCategory;
use App\Form\FilterCategoriesType;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function entree(RecipeRepository $recipeRepository, Request $request): Response
    {
        $filter = new FilterCategory();
        $form = $this->createForm(FilterCategoriesType::class, $filter);
        $form->handleRequest($request);
        $recipes = $recipeRepository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $recipes = $recipeRepository->findBy(['categories' => $filter->getCategory()]);
        }
        
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes, 'form' => $form->createView(),
        ]);
    }
}
