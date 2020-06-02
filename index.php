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

//start session
session_start();

require_once("models/functions.php");

//instantiate classes
$f3 = Base::instance();
$validator = new Validate();
$controller = new Controller($f3, $validator);

//home route
$f3->route('GET /', function(){
    $GLOBALS['controller']->home();
});

//personal information route
$f3->route('GET|POST /personal', function(){
    $GLOBALS['controller']->personal();
});

//profile route
$f3->route('GET|POST /profile', function(){
    $GLOBALS['controller']->profile();
});

//interests route
$f3->route('GET|POST /interests', function(){
    $GLOBALS['controller']->interests();
});

//summary route
$f3->route('GET|POST /summary', function(){
    $GLOBALS['controller']->summary();
});

//run fat free
$f3->run();
