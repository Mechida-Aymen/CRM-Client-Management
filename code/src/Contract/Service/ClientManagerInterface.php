<?php

// src/Contract/Service/ClientManagerInterface.php
namespace App\Contract\Service;

use App\Entity\Client;

interface ClientManagerInterface
{
    public function create(): Client;
    public function save(Client $client): void;
    public function delete(Client $client): void;
}
