<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Les champs à exclure du "trimming"
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
