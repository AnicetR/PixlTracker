<?php
/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 15/10/2016
 * Time: 16:10
 */

namespace System;

class storageManager
{
    private $storagePath;
    public $content, $header;

    /**
     * storageManager constructor.
     * @param $storageFileName
     * @param string $type
     * @param bool $isConfig
     */
    function __construct($storageFileName, $type = "", $isConfig = false){
        if($isConfig)
            $this->storagePath = '..';
        else
            $this->storagePath = STORAGE_PATH.DS;

        $this->genPath($storageFileName, $type);
        $this->getStorage();
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name){
        return $this->content->$name;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    function __set($name, $value){
        if(isset($this->content->$name))
            if($this->header->canBeModified)
                return $this->content->$name = $value;
        return false;
    }

    /**
     * @param $storageFileName
     * @param string $type
     * @throws \Exception
     */
    private function genPath($storageFileName, $type = ""){
        try{
            if(empty($type))
                $storagePath = $this->storagePath.DS.$storageFileName.'.json';
            else
                $storagePath = '..'.DS.$this->storagePath.$type.DS.$storageFileName.'.json';

            if(!file_exists($storagePath))
                throw new \Exception('This file doesn\'t exists');
            $this->storagePath = $storagePath;
        }catch(\Exception $e)
        {

        }
    }

    /**
     *
     */
    private function getStorage(){
        $storage = json_decode(file_get_contents($this->storagePath));
        $this->content = $storage->content;
        $this->header = $storage->header;
    }

    /**
     * @throws \Exception
     */
    public function save(){
        if(!$this->canBeModified())
            return;

        $storage = new \stdClass();
        $storage->header = $this->header;
        $storage->content = $this->content;
        file_put_contents($this->storagePath, json_encode($storage, JSON_PRETTY_PRINT));
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function canBeModified(){
        if($this->header->canBeModified)
            return true;

        throw new \Exception('This storage file cannot be modified. ('.$this->header->name.')');
    }


}