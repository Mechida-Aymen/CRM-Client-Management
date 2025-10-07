<?php

// src/Service/ClientManager.php
namespace App\Service;

use App\Entity\Client;
use App\Contract\Repository\ClientRepositoryInterface;
use App\Contract\Service\ClientManagerInterface;

class ClientManager implements ClientManagerInterface
{
    public function __construct(private readonly ClientRepositoryInterface $repo) {}

    public function create(): Client
    {
        return new Client();
    }

    public function save(Client $client): void
    {
        $this->repo->save($client);
    }

    public function delete(Client $client): void
    {
        $this->repo->remove($client);
    }

}
    