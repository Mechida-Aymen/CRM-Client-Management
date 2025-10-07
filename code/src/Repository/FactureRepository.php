<?php

namespace App\Repository;

use App\Contract\Repository\FactureRepositoryInterface;
use App\Entity\Client;
use App\Entity\Facture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Facture>
 */ 
class FactureRepository extends ServiceEntityRepository implements FactureRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $em,ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }


    public function save(Facture $facture): void
    {
        $this->em->persist($facture);
        $this->em->flush();
    }

    public function findById(int $id): ?Facture
    {
        return $this->em->createQueryBuilder()
        ->select('c')
        ->from(Facture::class, 'c')
        ->where('c.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }

    public function deleteFacture(Facture $facture): void
    {
        $this->em->remove($facture);
        $this->em->flush();
    }
    
    public function findPage(Client $client, int $page = 1, int $limit = 10): Paginator
    {
        $query = $this->em->createQueryBuilder()
            ->select('c')
            ->from(Facture::class, 'c')
            ->where('c.owner = :client')
            ->setParameter('client', $client)
            ->orderBy('c.id', 'DESC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery();

        return new Paginator($query);
    }

    public function factureByNumber($factureNumber): ?Facture
    {
        $facture = $this->em->createQueryBuilder()
            ->select('c')
            ->from(Facture::class, 'c')
            ->where('c.factureNumber = :factureNumber')
            ->setParameter('factureNumber', $factureNumber)
            ->getQuery()
            ->getOneOrNullResult();  

        return $facture; 
    }

    public function remove(Facture $facture):void
    {
        $this->em->remove($facture);
        $this->em->flush();
    }

    public function findLastFactureByDate(string $date): ?Facture
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.factureNumber LIKE :date')
            ->setParameter('date', '%' . $date . '%')
            ->orderBy('f.factureNumber', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

}

