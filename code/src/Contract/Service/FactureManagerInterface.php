<?php

// src/Contract/Service/FactureManagerInterface.php
namespace App\Contract\Service;

use App\Entity\Facture;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface FactureManagerInterface
{
    public function findPage(int $ownerId,int $page = 1, int $limit = 10): Paginator;
    public function create(Facture $facture, int $ownerId): void;
    public function delete(Facture $facture): void;
    public function edit(Facture $facture): void;

}
