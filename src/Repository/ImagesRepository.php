<?php

namespace App\Repository;

use App\Entity\Images;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Images|null find($id, $lockMode = null, $lockVersion = null)
 * @method Images|null findOneBy(array $criteria, array $orderBy = null)
 * @method Images[]    findAll()
 * @method Images[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Images::class);
    }
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    // /**
    //  * @return Images[] Returns an array of Images objects
    //  */
    
    public function findByAriticle($value)
    {
        return $this->createQueryBuilder('i')
                ->innerJoin('i.article', 'a')
            ->addSelect('i')

            ->andWhere('a.id = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
 

}
