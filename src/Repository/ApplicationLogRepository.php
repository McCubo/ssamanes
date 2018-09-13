<?php

namespace App\Repository;

use App\Entity\ApplicationLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ApplicationLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationLog[]    findAll()
 * @method ApplicationLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ApplicationLog::class);
    }

//    /**
//     * @return ApplicationLog[] Returns an array of ApplicationLog objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApplicationLog
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
