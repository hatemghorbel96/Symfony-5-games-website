<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Categorie;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{



    #[Route('/home/{page<\d+>?1}', name: 'home' )]
    public function index(ArticleRepository $articleRepository,Request $request,$page): Response
    {
        $limit =4;
        $start =$page*$limit-$limit;
        $total =count($articleRepository->findAll());
        $pages=ceil($total /$limit);

        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([],[],$limit,$start);
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $images = $this->getDoctrine()->getRepository(Image::class)->findAll();
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'trends' => $articleRepository->findtop(),
            'images'=> $images,
            'pages' => $pages,
            'page'=>$page,
            'dateD'=>$articleRepository->finddate(),
            'dateA'=>$articleRepository->finddateA(),
        ]);
    }

    #[Route('/about', name: 'about_me')]
    public function about() {
        
        return $this->render('article/about.html.twig');
         }

    /**
     * @Route ("/edit/{id}" ,name="edit_fav")
     */
    public function editfav($id) :Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        if ($article->getFavorit() == 0) {
            $article->setFavorit(1);
         
        } else {
            $article->setFavorit(0);
          
        }
        $entityManager->persist($article);
        $entityManager->flush();


     return $this->redirectToRoute('article_show',['id' => $article->getId()]);


    }


        

         

         #[Route('/{id}/show', name: 'article_show')]
         public function show($id,Request $request) {
           
             $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
             $entityManager = $this->getDoctrine()->getManager();
            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
             $v=$article->getView();
             $v+=1;
             $article->setView($v);
             $entityManager->persist($article);
             $entityManager->flush();
            
             $comment = new Comment();
             $form =$this->createForm(CommentType::class,$comment);
             $form->handleRequest($request);
             if ($form->isSubmitted() && $form->isValid()  ) {
               
                 $comment->setArticle($article);
                 $comment->setUser($this->getUser());
                 $comment->setCreatedAt(new \DateTimeImmutable('now'));
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($comment);
             $entityManager->flush();
             $this->addFlash(
                'success',
                "Thanks for rating");
                return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
                
             }
             return $this->render('article/show.html.twig',[
                'article' => $article,
                'articles'=>$articles,
                'form'=>$form->createView()
             ]         
              );}

}
