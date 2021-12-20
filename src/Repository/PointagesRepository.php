<?php

namespace App\Repository;

use App\Entity\Pointages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pointages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointages[]    findAll()
 * @method Pointages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method pointages[]    PointageHeureSemaine
 */
class PointagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointages::class);
    }

     
    public function PointageHeureSemaine($idUtil, $idChantier)
    {


       return $this->createQueryBuilder('ph')
       ->where('ph.utilisateur=:utilisateur')
       ->andWhere('ph.chantier=:chantier')
       ->setParameter('utilisateur',$idUtil)
       ->setParameter('chantier',$idChantier)
       ->getQuery()
       ->getResult();

    }
    

    /*
    public function findOneBySomeField($value): ?Pointages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
