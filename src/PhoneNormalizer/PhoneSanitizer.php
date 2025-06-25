<?php 

namespace App\PhoneNormalizer;

use App\Contracts\PhoneSanitizerInterface;

class PhoneSanitizer implements PhoneSanitizerInterface
{
    public const PATTERN = "/[^0-9]/";

    public function sanitize(string $phone): string
    {
        return preg_replace(self::PATTERN, '', $phone);
    }
}