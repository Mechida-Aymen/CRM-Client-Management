<?php

// src/Form/Validator/UniqueClientPhoneNumber/UniqueClientPhoneNumberAuthor.php

namespace App\Form\Validator\UniqueClientPhoneNumber;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class UniqueClientPhoneNumberAuthor extends Constraint
{
    public string $message = 'You already have a client with that phone number.';
}
