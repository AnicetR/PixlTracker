<?php
/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 16/10/2016
 * Time: 01:27
 */

namespace System;

use \Directory, \DateTime;

class trackersManager
{
    public $collection;

    /**
     * trackersManager constructor.
     */
    public function __construct()
    {
        $path = '..'.DS.STORAGE_PATH.DS .'trackers'.DS;
        $directory = opendir($path);

        while($f = readdir($directory)){
            if($f != '.' && $f != ".."){
                $f = str_replace('.json', '', $f);
                $this->collection[] = new storageManager($f, "trackers");
            }
        }
    }

    /**
     * @param string $order
     */
    public function orderByDate($order = "DESC")
    {
        usort($this->collection, function($a, $b) use ($order) {
            $aDT = new DateTime();
            $bDT = new DateTime();
            $aDT->setTimestamp($a->header->created_at);
            $bDT->setTimestamp($b->header->created_at);

            if ($aDT == $bDT) {
                return 0;
            }
            switch ($order){
                case "ASC":
                    return $aDT < $bDT ? -1 : 1;
                case "DESC":
                default:
                    return $aDT > $bDT ? -1 : 1;
            }
        });
    }

    /**
     * @param string $order
     */
    public function orderByViews($order = "DESC")
    {
        usort($this->collection, function($a, $b) use ($order) {
            if ($a->content->viewed == $b->content->viewed) {
                return 0;
            }
            switch ($order){
                case "ASC":
                    return $a->content->viewed < $b->content->viewed ? -1 : 1;
                case "DESC":
                default:
                    return $a->content->viewed > $b->content->viewed ? -1 : 1;
            }
        });
    }
}