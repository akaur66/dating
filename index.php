<?php
/*
 * Amardip Kaur
 * 4/27/20
 * this is the controller file
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload file
require_once('vendor/autoload.php');

//instantiate the F3 Base class
$f3 = Base::instance();

//home route
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

//personal information route
$f3->route('GET /personal', function(){
    $view = new Template();
    echo $view->render('views/personal.html');
});

//run fat free
$f3->run();
