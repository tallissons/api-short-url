<?php

namespace Tests\Feature\ShortURL;

use App\Models\ShortUrl;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StatsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_the_last_visit_on_short_url()
    {
        $this->withoutExceptionHandling();

        $shortUrl = ShortUrl::factory()->create();
        $this->get($shortUrl->code);

        $this->getJson(route('api.short-url.stats.last-visit', $shortUrl->code))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'last_visit' => $shortUrl->last_visit->toIso8601String()
            ]);

        $this->assertDatabaseHas('visits', [
            'short_url_id' => $shortUrl->id,
            'created_at' => Carbon::now(),
        ]);
    }
}
