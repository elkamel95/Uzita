<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservation::class);
    }
        public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }

    public function GetCountReservationAll()
    {
$count =  $this->createQueryBuilder('r')
        ->select('count(r.id) ')
            ->getQuery()
            
            ->getSingleScalarResult();

return $count;
    }

    
    public function GetCountReservation($id)
    {
$count =  $this->createQueryBuilder('r')
        ->select('count(r.id)')
        ->join('r.Article','a')
          ->andWhere('a.id = :val')
            ->setParameter('val', $id)

            ->getQuery()
            ->getSingleScalarResult();

return $count;
    }
        public function GetCountReservationComfirmer()
    {
$count =  $this->createQueryBuilder('r')
        ->select('count(r.id)')
          ->andWhere('r.IsOk = :val')
            ->setParameter('val', 1)

            ->getQuery()
            ->getSingleScalarResult();

return $count;
    }
    public function GetReservationByIDArticle($id)
    {
        return $this->createQueryBuilder('r')
            ->join('r.Article','a')
          ->andWhere('a.id = :val')
          ->groupBy('r.email')
            ->setParameter('val', $id)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*



    public function findOneBySomeField($value): ?Reservation
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
