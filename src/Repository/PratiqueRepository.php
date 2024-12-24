<?php

namespace App\Repository;


use App\Entity\Pratique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PratiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pratique::class);
    }

    public function findByCriteria($sport, $niveau, $departement = null)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->innerJoin('p.sport', 's')
            ->where('s.nomSport = :sport')
            ->andWhere('p.niveau = :niveau')
            ->setParameter('sport', $sport)
            ->setParameter('niveau', $niveau);

        if ($departement !== null) {
            $queryBuilder
                ->innerJoin('p.user', 'u')
                ->andWhere('u.Departement = :departement')
                ->setParameter('departement', $departement);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
