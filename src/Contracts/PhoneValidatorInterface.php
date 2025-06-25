<?php

namespace App\Contracts;

interface PhoneValidatorInterface
{
    public function validate(string $phone): void;
}