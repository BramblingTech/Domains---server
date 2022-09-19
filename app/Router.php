<?php

namespace App;

use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    public static function start(): void
    {
        require_once 'routes/api.php';
        parent::setDefaultNamespace('\App\Actions');
        parent::start();
    }
}
