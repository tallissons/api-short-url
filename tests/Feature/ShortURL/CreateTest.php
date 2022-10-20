<?php

namespace Tests\Feature\ShortURL;

use Facades\App\Actions\CodeGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_short_url()
    {
        $randomCode = Str::random(5);

        CodeGenerator::shouldReceive('run')
            ->once()
            ->andReturn($randomCode);

        $this->withoutExceptionHandling();

        $this->postJson(route('api.short-url.store'), [
            'url' => 'https://www.google.com'
        ])->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'short_url' => config('app.url') . '/' . $randomCode
            ]);

        $this->assertDatabaseHas('short_urls', [
            'url' => 'https://www.google.com',
            'short_url' => config('app.url')  . '/' . $randomCode,
            'code' => $randomCode
        ]);
    }

    public function test_url_valid()
    {
        $this->postJson(route('api.short-url.store'), [
            'url' => 'not-valid-url'
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'url' => __('validation.url', ['attribute' => 'url']),
            ]);
    }
}
