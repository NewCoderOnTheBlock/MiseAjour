<?php

namespace App\Repository;

use App\Entity\PayementInstruction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PayementInstruction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PayementInstruction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PayementInstruction[]    findAll()
 * @method PayementInstruction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayementInstructionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PayementInstruction::class);
    }

    // /**
    //  * @return PayementInstruction[] Returns an array of PayementInstruction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PayementInstruction
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
