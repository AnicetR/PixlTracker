<?php
/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 15/10/2016
 * Time: 16:08
 */

    require('../System/boostrapper.php');

//    $trackerId = System\Helpers\trackersHelper::create('test3');
//    $tracker = new System\Tracker($trackerId);
//
//    $tracker->render();

    if(isset($_GET['pixel'])){
        $tracker = new System\Tracker($_GET['pixel']);
        $tracker->render();
    }

    $trackers_list = new \System\trackersManager();

    echo '<pre>';
    //print_r($trackers_list);

    $trackers_list->orderByDate();
    //$trackers_list->orderByViews();

    print_r($trackers_list);

