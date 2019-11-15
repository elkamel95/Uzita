<?php

namespace App\Repository;

use App\Entity\Omra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Omra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Omra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Omra[]    findAll()
 * @method Omra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OmraRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Omra::class);
    }
   public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    // /**
    //  * @return Omra[] Returns an array of Omra objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Omra
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
