<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'article')]
    public function index(Request $request): Response
    {

        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

   /**
     * @Route ("/compte", name="compte_index")
     * @return Response
     */
    public function myAccount(ArticleRepository $repository){


        $v=$this->getUser();
        return $this->render('home/profile.html.twig',[
            'user'=>$this->getUser(),
            'favarts' => $repository->fav($v),
            'comnts'=>$repository->allcomments($v)
        ]);

    }

  

}


