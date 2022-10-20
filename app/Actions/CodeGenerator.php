<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CodeGenerator
{
    public function run()
    {
        return Str::random(5);
    }
}
