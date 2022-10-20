<?php

namespace Facades\App\Actions;

use Illuminate\Support\Facades\Facade;

/**
 *  @method static string run()
 */

class CodeGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Actions\CodeGenerator::class;
    }
}
