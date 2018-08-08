<?php

namespace App\Repository;

use App\Entity\WorkingDepartment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkingDepartment|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingDepartment|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingDepartment[]    findAll()
 * @method WorkingDepartment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingDepartmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkingDepartment::class);
    }

//    /**
//     * @return WorkingDepartment[] Returns an array of WorkingDepartment objects
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
    public function findOneBySomeField($value): ?WorkingDepartment
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
