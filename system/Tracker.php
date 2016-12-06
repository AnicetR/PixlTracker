<?php
/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 15/10/2016
 * Time: 18:24
 */

namespace System;


class Tracker extends storageManager
{
    private $storage;

    /**
     * Tracker constructor.
     * @param $id
     */
    function __construct($id)
    {
        $this->storage = parent::__construct($id, 'trackers');
    }

    /**
     *
     */
    public function render()
    {
        $this->getHistory();

        header( "Content-type: image/gif");
        header( "Expires: Wed, 5 Feb 1986 06:06:06 GMT");
        header( "Cache-Control: no-cache");
        header( "Cache-Control: must-revalidate");

        echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
    }

    /**
     * 
     */
    private function getHistory()
    {
        $this->content->viewed += 1;

        $this->content->history[] = [
            'date' => time(),
            'IP' => $_SERVER['REMOTE_ADDR'],
            'User Agent' => $_SERVER['HTTP_USER_AGENT']
        ];

        $this->save();
    }
}