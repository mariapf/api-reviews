<?php

namespace App\Repository;

use App\Entity\Review;
use App\Infrastructure\Repository\ResultCollection;
use App\Infrastructure\Repository\ResultCollectionInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * @param $hotelId
     * @param $dateStart
     * @param $dateEnd
     * @param $range
     * @return ResultCollectionInterface
     */
    public function findAverageReviewsByRange($hotelId, $dateStart, $dateEnd, $range) : ResultCollectionInterface
    {
        $results =  $this->createQueryBuilder('r')
            ->select("count(r.id) as reviewCount, date_part($range, r.created_date) AS dateGroup,
        avg(r.score) as averageScore")
            ->andWhere('r.hotel_id = :hotel_id')
            ->andWhere('r.created_date BETWEEN :date_start AND :date_end')
            ->setParameter('hotel_id', $hotelId)
            ->setParameter('date_start', $dateStart)
            ->setParameter('date_end', $dateEnd)
            ->groupBy('dateGroup')
            ->getQuery()
            ->getResult()
            ;

        return new ResultCollection($results);

    }


}
