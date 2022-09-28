<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

class QuotesTest extends TestCase
{
    public function testCheckingThirdPartyApiIsLive()
    {
        $response = Http::get('https://api.kanye.rest');

        if ($response->status() == 200) {
           $this->assertTrue(true);
        } else {
            $this->assertFalse(true);
        }
    }

    public function testGetQuotes()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);

        $content = json_decode($response->getContent());

        $response = $this->withHeaders(['Authorization' => 'Bearer '.$content->data->token])->getJson('/quotes');

        $response->assertOk();
    }

    public function testGetQuotesWithoutAuthorization()
    {
        $response = $this->getJson('/quotes');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
