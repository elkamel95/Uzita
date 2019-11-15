<?php

namespace App\Repository;

use App\Entity\Promos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Promos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promos[]    findAll()
 * @method Promos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Promos::class);
    }

        public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }

    public function findAllPromo($value)
    {
        return $this->createQueryBuilder('p')
           ->join('p.articles','a')
                       ->addSelect('a')

            ->andWhere('p.id != :val')
            ->setParameter('val', $value)
            
            ->orderBy('a.id', 'DESC')

            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Promos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
