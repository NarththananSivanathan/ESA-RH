<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offre>
 *
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    //    /**
    //     * @return Offre[] Returns an array of Offre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Offre
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function filterByCriteria(string $keyword = null, string $type_contrat = null): array
    {
        $queryBuilder = $this->createQueryBuilder('o');

        // Filtrage par mot-clé
        if ($keyword && strlen($keyword) >= 4) {
            $queryBuilder->andWhere('o.titre LIKE :keyword')
                ->setParameter('keyword', $keyword . '%');
        }

        // Filtrage par type de contrat
        if ($type_contrat) {
            $queryBuilder->andWhere('o.type_contrat = :type_contrat')
                ->setParameter('type_contrat', $type_contrat);
        }

        $queryBuilder->orderBy('o.date_creation', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}
