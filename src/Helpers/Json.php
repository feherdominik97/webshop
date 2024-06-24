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
        $file_path = "./storage/data/$key.json";

        if(file_exists($file_path)) {
            $content = file_get_contents($file_path);

            if($data = json_decode($content, true)){
                $array_of_objects = [];
                foreach ($data as $row) {
                    $class = "\App\Models\\$key";
                    $array_of_objects[] = new $class($row);
                }
                return $array_of_objects;
            }
        }

        return null;
    }

    /**
     * @param $key
     * @param $data
     * @return void
     */
    public static function put($key, $data)
    {
        $ree = file_put_contents("./storage/data/$key.json", json_encode($data));
        var_dump($ree);
        die();
    }
}