<?php

namespace App\Repository;

use App\Entity\Peliculas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Peliculas>
 *
 * @method Peliculas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peliculas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peliculas[]    findAll()
 * @method Peliculas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeliculasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peliculas::class);
    }

    public function save(Peliculas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Peliculas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByName($text): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT c FROM App\Entity\Contacto c WHERE c.nombre LIKE :text'
        )->setParameter('text', '%' . $text . '%');

        return $query->execute();
    }

//    /**
//     * @return Peliculas[] Returns an array of Peliculas objects
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

//    public function findOneBySomeField($value): ?Peliculas
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
