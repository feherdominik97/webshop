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
        $content = file_get_contents("./storage/webshop.json");

        if($data = json_decode($content, true)){
            $array_of_objects = [];
            foreach ($data[$key] as $row) {
                $class = "\App\Models\\$key";
                $array_of_objects[] = new $class($row);
            }
            return $array_of_objects;
        }

        return null;
    }
}