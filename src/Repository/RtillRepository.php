<?php

namespace App\Repository;

use App\Entity\Rtill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rtill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rtill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rtill[]    findAll()
 * @method Rtill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RtillRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rtill::class);
    }

    // /**
    //  * @return Rtill[] Returns an array of Rtill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rtill
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
