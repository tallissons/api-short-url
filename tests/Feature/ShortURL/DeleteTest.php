<?php

namespace Tests\Feature\ShortURL;

use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_a_short_url()
    {
        $shortUrl = ShortUrl::factory()->create();

        $this->deleteJson(route('api.short-url.delete', $shortUrl->code))
            ->assertStatus(Response::HTTP_NOT_FOUND);

        $this->assertDatabaseMissing('short_urls',[
            'id' => $shortUrl->id
        ]);
    }
}
