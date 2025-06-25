<?php

namespace App\PhoneNormalizer;

use App\Contracts\PhoneValidatorInterface;
use InvalidArgumentException;

class PhoneValidator implements PhoneValidatorInterface
{
    public function validate(string $phone): void
    {
        if (!preg_match('/^7\d{10}$/', $phone)) {
            throw new InvalidArgumentException("Provided phone number {$phone} isn\'t correct");
        }
    } 
}
