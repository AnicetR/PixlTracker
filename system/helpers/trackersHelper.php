<?php

/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 15/10/2016
 * Time: 17:37
 */

namespace System\Helpers;
use \stdClass;

class trackersHelper
{
    /**
     * @param $name
     * @return mixed
     */
    public static function create($name)
    {
        $tracker = self::generateContent($name);
        $path = '..'.DS.STORAGE_PATH.DS.'trackers'.DS.$tracker->header->id.'.json';

        file_put_contents($path, json_encode($tracker, JSON_PRETTY_PRINT));
        return $tracker->header->id;
    }

    /**
     * @param $name
     * @return stdClass
     */
    public static function generateContent($name){
        $tracker = new stdClass();
        $tracker->header = new stdClass();
        $tracker->content = new stdClass();

        $tracker->header->name = $name;
        $tracker->header->id = uniqid('');
        $tracker->header->created_at = time();
        $tracker->header->canBeModified = true;

        $tracker->content->viewed = 0;
        $tracker->content->history = [];

        return $tracker;
    }
}