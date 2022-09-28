<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotesResource;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function index(ApiService $service)
    {
        $quotes = $service->getQuotes();

        return QuotesResource::collection($quotes);
    }
}
