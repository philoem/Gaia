<?php

namespace App\Repository;

use App\Entity\Adverts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adverts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adverts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Members[]    findAll()
 * @method Adverts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adverts::class);
    }

    /**
     * @return Adverts[] Returns an array of Adverts objects
     */  
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
   
    public function findOneBySomeField($value): ?Adverts
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
