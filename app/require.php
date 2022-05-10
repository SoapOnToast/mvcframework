<?php
    //require libaries from folder libararies
    require_once 'libraries/Core.class.php';
    require_once 'libraries/Controller.class.php';
    require_once 'libraries/Database.class.php';
    require_once('libraries/htmlpurifier-4.14.0/library/HTMLPurifier.auto.php');

    require_once 'helpers/session_helper.php';

    require_once('config/config.php');



    //instantiate core class
    $init = new Core();
