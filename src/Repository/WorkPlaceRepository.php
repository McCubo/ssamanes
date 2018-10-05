<?php

namespace App\Repository;

use App\Entity\WorkPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkPlace[]    findAll()
 * @method WorkPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkPlaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkPlace::class);
    }

    public function getActiveCount(): ? int
    {
        $queryBuilder = $this->createQueryBuilder('wp');
        return $queryBuilder
            ->select('count(wp.id)')
            ->andWhere('wp.status = :status')
            ->setParameter('status', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }
//    /**
//     * @return WorkPlace[] Returns an array of WorkPlace objects
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
    public function findOneBySomeField($value): ?WorkPlace
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
