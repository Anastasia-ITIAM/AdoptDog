<?php

namespace App\Repository;

use App\Entity\Dog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dog>
 */
class DogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dog::class);
    }

    public function findByFilters(string $breed = '', string $age = '', string $gender = '', string $size = ''): array
    {
        $qb = $this->createQueryBuilder('d')
            ->where('d.isAdopted = :adopted')
            ->setParameter('adopted', false);

        if (!empty($breed)) {
            $qb->andWhere('d.breed LIKE :breed')
               ->setParameter('breed', '%' . $breed . '%');
        }

        if (!empty($age)) {
            switch ($age) {
                case '0-1':
                    $qb->andWhere('d.age BETWEEN 0 AND 1');
                    break;
                case '1-3':
                    $qb->andWhere('d.age BETWEEN 1 AND 3');
                    break;
                case '3-7':
                    $qb->andWhere('d.age BETWEEN 3 AND 7');
                    break;
                case '7+':
                    $qb->andWhere('d.age >= 7');
                    break;
            }
        }

        if (!empty($gender)) {
            $qb->andWhere('d.gender = :gender')
               ->setParameter('gender', $gender);
        }

        if (!empty($size)) {
            $qb->andWhere('d.size = :size')
               ->setParameter('size', $size);
        }

        return $qb->orderBy('d.id', 'DESC')
                  ->getQuery()
                  ->getResult();
    }
}