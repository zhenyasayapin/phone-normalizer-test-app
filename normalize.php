<?php

use App\PhoneNormalizer\PhoneMask;
use App\PhoneNormalizer\PhoneNormalizer;
use App\PhoneNormalizer\PhoneSanitizer;
use App\PhoneNormalizer\PhoneValidator;

require_once __DIR__ . '/vendor/autoload.php';

$phones = require_once __DIR__ . '/input.php';

$normalizer = new PhoneNormalizer(
        new PhoneSanitizer(),
    new PhoneValidator(),
    new PhoneMask()
);

try {
    print_r($normalizer->normalize($phones));
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}