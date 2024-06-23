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
        $content = file_get_contents("./storage/data/$key.json");

        if($data = json_decode($content, true)){
            $array_of_objects = [];
            foreach ($data as $row) {
                $class = "\App\Models\\$key";
                $array_of_objects[] = new $class($row);
            }
            return $array_of_objects;
        }

        return null;
    }

    public static function put($key, $data)
    {
        $newJsonString = json_encode($data);
        file_put_contents("./storage/data/$key.json", $newJsonString);
    }
}