<?php

// src/Security/Voter/ClientVoter.php

namespace App\Security\Voter;

use App\Entity\Facture;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class FactureVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['EDIT', 'DELETE']) && $subject instanceof Facture;
    }

    protected function voteOnAttribute(string $attribute, $facture, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($facture->getOwner()->getAuthor() === $user) {
            return true; 
        }

        return false; 
    }
}
