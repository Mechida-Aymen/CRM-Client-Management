<?php

// src/Enum/FactureStatus.php
namespace App\Enum;

enum FactureStatusEnum: string
{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case PARTIALLY_PAID = 'partially_paid';
}