<?php
/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 15/10/2016
 * Time: 16:09
 */


define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function( $class ) {
    $classFile = str_replace('\\', DS, $class);
    $classPI = pathinfo($classFile);
    $filepath = strtolower('..'.DS.$classPI[ 'dirname' ]) . DS . $classPI[ 'filename' ] . '.php';
    if(file_exists($filepath))
        include_once($filepath);
});
    
    $config = new System\storageManager('config', '', true);
    define('STORAGE_PATH', $config->storagePath);
    



