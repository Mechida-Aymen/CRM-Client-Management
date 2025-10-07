<?php

// src/Repository/ClientRepository.php
namespace App\Repository;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use App\Contract\Repository\ClientRepositoryInterface;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $em, ManagerRegistry $registry) 
    {
        parent::__construct($registry, Client::class);
    }

    public function save(Client $client): void
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    public function findById(int $id): ?Client
    {
        return $this->em->createQueryBuilder()
        ->select('c')
        ->from(Client::class, 'c')
        ->where('c.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }

    public function remove(Client $client): void
    {
        $this->em->remove($client);
        $this->em->flush();
    }

    public function findPage(User $user, int $page = 1, int $limit = 10): Paginator
    {
        $query = $this->em->createQueryBuilder()
            ->select('c')
            ->from(Client::class, 'c')
            ->where('c.author = :user')
            ->setParameter('user', $user)
            ->orderBy('c.id', 'DESC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery();

        return new Paginator($query);
    }

    public function findClientByPhone($phone, $author): ?Client
    {
        $client = $this->em->createQueryBuilder()
            ->select('c')
            ->from(Client::class, 'c')
            ->where('c.phoneNumber = :phone')
            ->andWhere('c.author = :author')
            ->setParameter('phone', $phone)
            ->setParameter('author', $author)
            ->getQuery()
            ->getOneOrNullResult();  

        return $client;  
    }   

}
