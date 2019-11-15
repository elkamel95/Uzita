<?php

namespace App\Repository;

use App\Entity\Detailoffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Detailoffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailoffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailoffre[]    findAll()
 * @method Detailoffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailoffreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Detailoffre::class);
    }
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    // /**
    //  * @return Detailoffre[] Returns an array of Detailoffre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detailoffre
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
