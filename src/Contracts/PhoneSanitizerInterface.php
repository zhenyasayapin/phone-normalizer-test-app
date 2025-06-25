<?php

namespace App\Contracts;

interface PhoneSanitizerInterface 
{
    public function sanitize(string $phone): string;
}