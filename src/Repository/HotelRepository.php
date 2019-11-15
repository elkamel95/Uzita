<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hotel::class);
    }
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    // /**
    //  * @return Hotel[] Returns an array of Hotel objects
    //  */
    

    public function findIDPaye($PayeId)
    {
        return $this->createQueryBuilder('h')
            // p.category refers to the "category" property on product
            ->innerJoin('h.sejour', 's')
            // selects all the category data to avoid the query
            ->addSelect('h')
            ->andWhere('s.id = :id')
            ->setParameter('id', $PayeId)
            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

        public function findIDPayetrange($PayeId)
    {
        return $this->createQueryBuilder('h')
            // p.category refers to the "category" property on product
            ->innerJoin('h.sejour', 's')
            // selects all the category data to avoid the query
            ->addSelect('h')
            ->andWhere('s.id != :id')
            ->setParameter('id', $PayeId)
            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
      public function findPaye($Paye,$etoile)
    {
        return $this->createQueryBuilder('h')
            // p.category refers to the "category" property on product
            ->innerJoin('h.sejour', 's')
            // selects all the category data to avoid the query
            ->addSelect('h')
   ->andWhere(' s.paye LIKE  :paye')
      ->andWhere(' h.etoile  <=  :etoile')

            ->setParameter('paye', '%'.$Paye.'%')
                        ->setParameter('etoile', $etoile)

            ->orderBy('h.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
  public function findVille($Paye,$etoile)
    {
        return $this->createQueryBuilder('h')
            // p.category refers to the "category" property on product
            ->innerJoin('h.aticle', 'a')
            // selects all the category data to avoid the query
            ->addSelect('h')
   ->andWhere(' a.dest LIKE  :paye')
      ->andWhere(' h.etoile  <=  :etoile')

            ->setParameter('paye', '%'.$Paye.'%')
                        ->setParameter('etoile', $etoile)

            ->orderBy('h.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

          public function findPayeAndDate($Paye,$etoile,$from,$to)
    {
        return $this->createQueryBuilder('h')
            ->innerJoin('h.sejour', 's')
->innerJoin('h.aticle', 'a')
            // selects all the category data to avoid the query
            ->addSelect('h')
   ->andWhere(' s.paye LIKE  :paye')
      ->andWhere(' h.etoile  <=  :etoile')
      ->andWhere('a.datedep <=:from ')
            ->andWhere('a.datearriv >= :to')
      ->setParameter('from', $from )

      ->setParameter('to', $to )
      ->setParameter('paye', $Paye.'%')
                        ->setParameter('etoile', $etoile)

            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
public function findVillAndDate($Paye,$etoile,$from,$to)
    {
        return $this->createQueryBuilder('h')
            ->innerJoin('h.sejour', 's')
->innerJoin('h.aticle', 'a')
            // selects all the category data to avoid the query
            ->addSelect('h')
   ->andWhere(' a.dest LIKE  :paye')
      ->andWhere(' h.etoile  <=  :etoile')
     ->andWhere('a.datedep <=:from ')
            ->andWhere('a.datearriv >= :to')
      ->setParameter('from', $from )
      ->setParameter('to', $to)
      ->setParameter('paye', $Paye.'%')
                        ->setParameter('etoile', $etoile)

            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
         public function findEtoil($etoile)
    {
        return $this->createQueryBuilder('h')
            // p.category refers to the "category" property on product
            // selects all the category data to avoid the query
            ->addSelect('h')
   ->andWhere(' h.etoile LIKE  :etoile')
            ->setParameter('etoile', $etoile.'%')
            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
  
    public function findByTopHotel($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.topHotel = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
        ;
    }
        public function findAllHot()
    {
        return $this->createQueryBuilder('h')

           
            ->orderBy('h.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
   
}
