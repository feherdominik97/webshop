<?php

namespace App\Helpers;

/**
 *
 */
class Json {
    /**
     * @param $key
     * @return array|mixed
     */
    public static function get($key)
    {
        $protocol = isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $base_url = $protocol . $_SERVER['HTTP_HOST'];

        return json_decode(file_get_contents("$base_url/storage/webshop.json"))->{$key} ?? []; //get content of file then decode it and get the value of the key.
    }
}