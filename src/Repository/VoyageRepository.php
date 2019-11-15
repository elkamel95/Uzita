<?php

namespace App\Repository;

use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Voyage::class);
    }
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    // /**
    //  * @return Voyage[] Returns an array of Voyage objects
    //  */
        public function findBySejour($value)
    {
        return $this->createQueryBuilder('v')
        ->innerJoin('v.sejour','s')
            ->andWhere('s.paye = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

            public function findAllcircuits()
    {
        return $this->createQueryBuilder('v')
        ->Join('v.circuit','c')
        ->addSelect('v')
            ->andWhere('c.id != :val')
            ->setParameter('val', 'null')
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
     public function findAlltransfert()
    {
        return $this->createQueryBuilder('v')
        ->Join('v.transfert','t')
        ->addSelect('v')
            ->andWhere('t.id != :val')
            ->setParameter('val', 'null')
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
      public function findPayET()
    {
      return $this->createQueryBuilder('v')
        ->innerJoin('v.sejour','s')
            ->andWhere('s.paye != :val')
            ->setParameter('val', 'TUNISIE')

            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


        public function findArticleByDatDepart($from,$to,$paye,$dest)
    {



        return $this->createQueryBuilder('v')
        ->innerJoin('v.Article','a')
        ->innerJoin('v.sejour','s')

        ->addSelect('v')
->andWhere('a.datedep BETWEEN :from AND :to')
->andWhere('a.datearriv <= :to')
->andWhere('a.dest LIKE :dest  ')

        ->setParameter('dest', '%'.$dest.'%' )

        ->setParameter('from', $from )

        ->setParameter('to', $to)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }
        public function findPaye($paye,$dest)
    {
        return        $this->createQueryBuilder('v')
        ->innerJoin('v.Article','a')
        ->innerJoin('v.sejour','s')
        ->addSelect('v')
        ->andWhere('a.dest LIKE :dest  ')
        ->setParameter('dest', '%'.$dest.'%' )
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Voyage
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
