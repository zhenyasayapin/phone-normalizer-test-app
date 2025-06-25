<?php

namespace App\PhoneNormalizer;

use App\Contracts\PhoneMaskInterface;
use App\Contracts\PhoneNormalizerInterface;
use App\Contracts\PhoneSanitizerInterface;
use App\Contracts\PhoneValidatorInterface;

class PhoneNormalizer implements PhoneNormalizerInterface
{
    public function __construct(
        private PhoneSanitizerInterface $sanitizer,
        private PhoneValidatorInterface $validator,
        private PhoneMaskInterface $mask,
    ){}

    public function normalize(array $phones): array  
    {
        foreach ($phones as $i => $phone) {
            $sanitized = $this->sanitizer->sanitize($phone);

            $this->validator->validate($sanitized);

            $phones[$i] = $this->mask->mask($sanitized);
        }

        return $phones;
    }
}