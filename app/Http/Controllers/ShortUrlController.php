<?php

namespace App\Http\Controllers;

use Facades\App\Actions\CodeGenerator;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShortUrlController extends Controller
{
    public function store()
    {
        request()->validate([
            'url' => 'required|url'
        ]);

        $code = CodeGenerator::run();

        $shortUrl = ShortUrl::query()->firstOrCreate([
            'url' => request('url')],
            [
            'short_url' => config('app.url') . '/' . $code,
            'code' => $code
        ]);

        return response()->json([
            'short_url' => $shortUrl->short_url
        ], Response::HTTP_CREATED);
    }

    public function destroy(ShortUrl $shortUrl)
    {
        $shortUrl->query()->delete();

        return response()->json([], Response::HTTP_NOT_FOUND);
    }
}
