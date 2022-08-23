<?php

namespace App\Repository;

use App\Entity\Weather;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Weather>
 *
 * @method Weather|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weather|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weather[]    findAll()
 * @method Weather[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weather::class);
    }

    public function add(Weather $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Weather $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMinimalTemperature(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT MIN(weather.temp_min) as `tempX`
        FROM weather';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([]);
        return $resultSet->fetchAllAssociative();
    }

    public function findMaximalTemperature(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT MAX(weather.temp_max) as `tempX`
        FROM weather';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([]);
        return $resultSet->fetchAllAssociative();
    }

    public function findAvgTemperature(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT AVG(weather.temp) as `tempX`
        FROM weather';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([]);
        return $resultSet->fetchAllAssociative();
    }

    public function findTopCity(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT
            city,
            COUNT(city) AS `value_occurrence` 
        FROM weather
        GROUP BY city
        ORDER BY 
            `value_occurrence` DESC
        LIMIT 1;';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([]);
        return $resultSet->fetchAllAssociative();
    }   

    public function findCountRows(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT
            COUNT(*) AS `summary`
        FROM weather;';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([]);
        return $resultSet->fetchAllAssociative();
    }  



//    /**
//     * @return Weather[] Returns an array of Weather objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Weather
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
