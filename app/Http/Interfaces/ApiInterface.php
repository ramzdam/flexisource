<?php

namespace App\Http\Interfaces;

/**
 * Responsible for setting function to be used in API Service
 */
interface ApiInterface
{
    public function send($method, $url, $format, $params = []);
}