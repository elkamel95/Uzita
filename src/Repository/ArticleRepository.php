<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
     public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    public function findByPromo($value,$max)
    {
        return $this->createQueryBuilder('a')
        ->innerJoin('a.promo', 'p')

            ->andWhere('p.id != :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($max)
            ->getQuery()
            ->getResult()
        ;
    }

        public function findAllforSlider()
    {
        return $this->createQueryBuilder('a')
     
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByTopDistination($value)
    {
        return $this->createQueryBuilder('a')

            ->andWhere('a.topDistination = :val')
            ->setParameter('val', 1)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }



        public function findArticleByDatDepart($from,$to,$paye,$dest)
    {



        return $this->createQueryBuilder('a')
        ->innerJoin('a.voyage','v')
        ->innerJoin('v.sejour','s')

        ->addSelect('v')
->andWhere('a.datedep BETWEEN :from AND :to')
->andWhere('a.datearriv <= :to')
->andWhere('a.dest LIKE :dest  ')

->andWhere('s.paye LIKE :paye  ')
        ->setParameter('paye', $paye )
        ->setParameter('dest', $dest )

        ->setParameter('from', $from )
                ->setParameter('paye', '%'.$paye.'%' )

        ->setParameter('to', $to)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }
   

    public function findPaye($paye,$dest)
    {
        return        $this->createQueryBuilder('a')
        ->innerJoin('a.voyage','v')
        ->innerJoin('v.sejour','s')
        ->addSelect('v')
        ->andWhere('a.dest LIKE :dest  ')
        ->setParameter('dest', '%'.$dest.'%' )
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    
}
