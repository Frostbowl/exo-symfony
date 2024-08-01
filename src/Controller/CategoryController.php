<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function home(ManagerRegistry $manager) :Response
    {
        $categories = $manager->getRepository(Category::class)->findAll();
        return $this->render('post/index.html.twig', [
            'categories'=>$categories
        ]);
    }

    
    #[Route('/category/save', name:'add_category')]
    public function save(Request $request, ManagerRegistry $manager):Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $om = $manager->getManager();
            $om->persist($category);
            $om->flush();

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/save.html.twig',[
            'categoryForm'=>$form,
        ]);
    }
}
