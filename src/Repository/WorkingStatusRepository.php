<?php

namespace App\Repository;

use App\Entity\WorkingStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkingStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingStatus[]    findAll()
 * @method WorkingStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkingStatus::class);
    }

    public function getActiveCount(): ? int
    {
        $queryBuilder = $this->createQueryBuilder('ws');
        return $queryBuilder
        ->select('count(ws.id)')
        ->andWhere('ws.status = :status')
        ->setParameter('status', 1)
        ->getQuery()
        ->getSingleScalarResult();
    }
//    /**
//     * @return WorkingStatus[] Returns an array of WorkingStatus objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkingStatus
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
