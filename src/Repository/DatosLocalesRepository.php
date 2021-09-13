<?php

namespace App\Repository;

use App\Entity\DatosLocales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DatosLocales|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosLocales|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosLocales[]    findAll()
 * @method DatosLocales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosLocalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatosLocales::class);
    }

    // /**
    //  * @return DatosLocales[] Returns an array of DatosLocales objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DatosLocales
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * @return DatosLocales[] Returns an array of DatosLocales objects
    */
    public function comunidades()
    {
        return $this->createQueryBuilder('d')
            ->select('d.comunidad')
            ->distinct('d.comunidad')
            ->orderBy('d.comunidad', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return DatosLocales[] Returns an array of DatosLocales objects
    */
    public function ciudades(String $value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.comunidad = :val')
            ->setParameter('val', $value)
            ->select('d.provincia')
            ->distinct('d.provincia')
            ->orderBy('d.provincia', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return DatosLocales[] Returns an array of DatosLocales objects
    */
    public function municipios(String $value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.provincia = :val')
            ->setParameter('val', $value)
            ->select('d.municipio, d.latitud, d.longitud')
            ->orderBy('d.municipio', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
