<?php

namespace App\Controller;

use App\Entity\FilterCategory;
use App\Form\FilterCategoriesType;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/recipe", name="recipe_")
*/
class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(RecipeRepository $recipeRepository, Request $request): Response
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
    /**
     * @Route("/offres/{id}", name="offer_show")
     */
    public function show(int $id): Response
    {
        $job = $this->getDoctrine()
            ->getRepository(Job::class)
            ->find($id);

        if (!$job) {
            throw $this->createNotFoundException(
                'Aucune offre d\'emploi correspondante à l\'identifiant ' . $id
            );
        }
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}
