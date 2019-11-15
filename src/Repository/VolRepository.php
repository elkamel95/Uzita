<?php

namespace App\Repository;

use App\Entity\Vol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vol[]    findAll()
 * @method Vol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vol::class);
    }

      public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    public function findByVolAlleRetoure( $TypeVol,$depart,$dest)
    {
        return $this->createQueryBuilder('v')
        ->innerJoin('v.article','a')
      

              ->andWhere('v.TypeVol = :TypeVol')
            ->setParameter('TypeVol', $TypeVol)

              ->andWhere('v.depart LIKE :depart')
              ->setParameter('depart', '%'.$depart.'%')

        
            ->andWhere('a.dest LIKE :dest  ')

           ->setParameter('dest', '%'.$dest.'%' )


            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
}



}
