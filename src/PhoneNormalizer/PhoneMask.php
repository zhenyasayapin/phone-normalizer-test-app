<?php

namespace App\PhoneNormalizer;

use App\Contracts\PhoneMaskInterface;

class PhoneMask implements PhoneMaskInterface
{
    private const PATTERN = '/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/';

    public function mask(string $phone): string
    {
        return preg_replace(
            self::PATTERN, 
            '$1 ($2) $3 $4 $5',
            $phone
        );
    }
}