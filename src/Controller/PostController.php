<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'index')]
    public function home(ManagerRegistry $manager) :Response
    {
        $categories = $manager->getRepository(Category::class)->findAll();
        return $this->render('post/index.html.twig', [
            'categories'=>$categories
        ]);
    }
}