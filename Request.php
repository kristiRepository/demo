<?php


class Request
{

    public static function uri()
    {
        return trim(substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 12), '/');
    }

    public static function method()
    {

        return $_SERVER['REQUEST_METHOD'];
    }
}
