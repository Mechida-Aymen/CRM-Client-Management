<?php

// src/Contract/Repository/ClientRepositoryInterface.php
namespace App\Contract\Repository;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface ClientRepositoryInterface
{
    public function save(Client $client): void;
    public function findById(int $id): ?Client;
    public function remove(Client $client): void;
    public function findPage(User $user, int $page = 1, int $limit = 10): Paginator;
    public function findClientByPhone($phone, $author): ?Client;
}

