<?php

namespace App\Contract\Repository;

use App\Entity\Client;
use App\Entity\Facture;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface FactureRepositoryInterface
{
    public function save(Facture $facture): void;
    public function remove(Facture $facture): void;
    public function findById(int $id): ?Facture;
    public function deleteFacture(Facture $facture): void;
    public function findPage(Client $client, int $page = 1, int $limit = 10): Paginator;
    public function factureByNumber($factureNumber): ?Facture;
    public function findLastFactureByDate(string $date): ?Facture;
}