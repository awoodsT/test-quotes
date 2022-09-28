<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends TestCase
{
    public function testLoginAndAuthenticated()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);

        $response
            ->assertOk()
            ->assertJsonStructure(['data' => ['token']]);

        $content = json_decode($response->getContent());

        $response = $this->withHeaders(['Authorization' => 'Bearer '.$content->data->token])->getJson('/quotes');

        $response->assertOk();
    }

    public function testLoginWrongPassword()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '12345678q',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
