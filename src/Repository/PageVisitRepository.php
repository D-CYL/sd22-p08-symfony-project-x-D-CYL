<?php

namespace App\Repository;

use App\Entity\PageVisit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PageVisit>
 *
 * @method PageVisit|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageVisit|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageVisit[]    findAll()
 * @method PageVisit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageVisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageVisit::class);
    }

//    /**
//     * @return PageVisit[] Returns an array of PageVisit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PageVisit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
