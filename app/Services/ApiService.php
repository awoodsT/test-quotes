<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public function getQuotes()
    {
        $response = [];

        while (count($response) < 5) {
            $response[] = Http::get('https://api.kanye.rest')->json('quote');
        }

        return $response;
    }
}
