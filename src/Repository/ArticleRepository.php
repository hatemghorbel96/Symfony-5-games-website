<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function fav($v)
    {
       
        return $this->createQueryBuilder('a')  
        ->andWhere("a.favorit=1 and a.user=:v")->setParameter("v",$v) 
           
            ->getQuery()
            ->getResult()
        ;
    }

    public function findtop()
    {
        return $this->createQueryBuilder('a')       
            ->orderBy('a.View', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findDate()
    {
        return $this->createQueryBuilder('a')       
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findDateA()
    {
        return $this->createQueryBuilder('a')       
            ->orderBy('a.createdAt', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }


    
    public function allcomments($v)
    {
       
        return $this->createQueryBuilder('a')  
        ->leftJoin('a.comments', 'c')
        ->andWhere("c.user=:v")->setParameter("v",$v)        
            ->getQuery()
            ->getResult()
        ;
    }

    
    // public function allcomments($v)
    // {
    // $em = $this->getEntityManager();
    // $req = $em->createQuery(
    // 'SELECT a FROM App\Entity\Article a  JOIN a.comments AS c
    // WHERE c.user=:v'
    // )->setParameter('v', $v);
   
    // return $req->getResult();
    // }



}
