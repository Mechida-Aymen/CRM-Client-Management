<?php

// src/Service/ClientManager.php
namespace App\Service;

use App\Contract\Repository\ClientRepositoryInterface;
use App\Entity\Client;
use App\Contract\Repository\FactureRepositoryInterface;
use App\Contract\Service\FactureManagerInterface;
use App\Entity\Facture;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FactureManager implements FactureManagerInterface
{
    public function __construct(private readonly FactureRepositoryInterface $repo,
        private readonly ClientRepositoryInterface $ClientRepo)
    {}

    public function findPage( int $ownerId,int $page = 1, int $limit = 10): Paginator
    {
        $owner = $this->ClientRepo->findById($ownerId);
        $factures = $this->repo->findPage($owner, $page, $limit);
        return $factures;
    }

    public function create(Facture $facture, int $ownerId): void
    {
        $newFactureNumber = $this->generateFactureIdentifiant();
        $facture->setFactureNumber($newFactureNumber);

        $client = $this->ClientRepo->findById($ownerId);
        $facture->setOwner($client);

        $facture->getOwner();

        $this->repo->save($facture);
    }

    public function edit(Facture $facture): void
    {
        $this->repo->save($facture);
    }

    public function delete(Facture $facture): void
    {
        $this->repo->remove($facture);
    }

    private function generateFactureIdentifiant(): string
    {
        $currentDate = (new \DateTime())->format('Ymd');
        
        $uniqueId = uniqid();

        $lastFacture = $this->repo->findLastFactureByDate($currentDate);
        
        $sequence = $lastFacture ? (int)substr($lastFacture->getFactureNumber(), -3) + 1 : 1;
        
        $sequenceFormatted = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        return 'FACT-' . $currentDate . '-' . $sequenceFormatted . '-' . $uniqueId;
    }
 

}
    