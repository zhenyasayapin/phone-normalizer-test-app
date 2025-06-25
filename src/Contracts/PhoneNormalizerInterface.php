<?php

namespace App\Contracts;

interface PhoneNormalizerInterface 
{
    public function normalize(array $phones): array;
}