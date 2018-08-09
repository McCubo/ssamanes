<?php

namespace App\Repository;

use App\Entity\CompetitionLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompetitionLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetitionLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetitionLevel[]    findAll()
 * @method CompetitionLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitionLevelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompetitionLevel::class);
    }

//    /**
//     * @return CompetitionLevel[] Returns an array of CompetitionLevel objects
//     */
    /*
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
    */

    /*
    public function findOneBySomeField($value): ?CompetitionLevel
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
