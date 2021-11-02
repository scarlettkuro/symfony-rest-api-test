<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\ArticleGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use App\Form\ArticleType;

/**
 * Description of DefaultController
 *
 * @author kuro
 */
class DefaultController  extends AbstractController
{
    public function index(EntityManagerInterface $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();
        
        return $this->render('base.html.twig', [
            'articles' => $articles,
        ]);
    }
}
