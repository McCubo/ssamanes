<?php

namespace App\Repository;

use App\Entity\BenefitType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BenefitType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BenefitType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BenefitType[]    findAll()
 * @method BenefitType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BenefitTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BenefitType::class);
    }

    /**
     * 
     * @return int|NULL Number of active records on the database.
     */
    public function getActiveCount(): ? int {
        $queryBuilder = $this->createQueryBuilder('bt');
        return $queryBuilder
            ->select('count(bt.id)')
            ->andWhere('bt.status = :status')
            ->setParameter('status', 1)
        ->getQuery()->getSingleScalarResult();
    }
//    /**
//     * @return BenefitType[] Returns an array of BenefitType objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BenefitType
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
