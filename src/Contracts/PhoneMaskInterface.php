<?php

namespace App\Contracts;

interface PhoneMaskInterface 
{
    public function mask(string $phone): string;
}