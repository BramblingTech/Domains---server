<?php

if (!function_exists('env')) {
    function env(string $name, $default = null)
    {
        return $_ENV[$name] ?? $default;
    }
}
