<?php

$phones = require __DIR__ . '/input.php';

interface PhoneNormalizerInterface 
{
    public function normalize(array $phones): array;
}

interface PhoneMaskInterface 
{
    public function mask(string $phone): string;
}

interface PhoneValidatorInterface
{
    public function validate(string $phone): void;
}

interface PhoneSanitizerInterface 
{
    public function sanitize(string $phone): string;
}

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

class PhoneMask implements PhoneMaskInterface
{
    private const PATTERN = '/(\d{1})(\d{3})(\d{3})(\d{4})/';

    public function mask(string $phone): string
    {
        return preg_replace(
            self::PATTERN, 
            '$1($2) $3-$4', 
            $phone
        );
    }
}

class PhoneValidator implements PhoneValidatorInterface
{
    public function validate(string $phone): void
    {
        if (!preg_match('/^7\d{10}$/', $phone)) {
            throw new InvalidArgumentException("Provided phone number {$phone} isn\'t correct");
        }
    } 
}

class PhoneSanitizer implements PhoneSanitizerInterface
{
    public const PATTERN = "/[^0-9]/";

    public function sanitize(string $phone): string
    {
        return preg_replace(self::PATTERN, '', $phone);
    }
}

$normalizer = new PhoneNormalizer(
        new PhoneSanitizer(),
    new PhoneValidator(),
    new PhoneMask(),
);

try {
    print_r($normalizer->normalize($phones));
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
