<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class World extends Facade {

    protected static function getFacadeAccessor() { return 'hello'; }

}