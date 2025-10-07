<?php 

// src/Form/Validator/UniqueClientPhoneNumber/UniqueClientPhoneNumberAuthorValidator.php

namespace App\Form\Validator\UniqueClientPhoneNumber;

use App\Contract\Repository\ClientRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueClientPhoneNumberAuthorValidator extends ConstraintValidator
{
    public function __construct(
        private readonly ClientRepositoryInterface $clientRepository
    ) {}

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $client = $this->context->getRoot()->getData(); 
        $author = $client->getAuthor();

        if (!$author) return;

        $existing = $this->clientRepository->findClientByPhone($value, $author);

        if ($existing && $existing->getId() !== $client->getId()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('phoneNumber')
                ->addViolation();
        }
    }
}
