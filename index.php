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

require_once("models/functions.php");

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

//profile route
$f3->route('GET /profile', function($f3){

    $allStates = getStates();
    $f3->set('allStates', $allStates);

    $view = new Template();
    echo $view->render('views/profile.html');
});

//interests route
$f3->route('GET /interests', function($f3){

    $allInInterests = getInInterests();
    $f3->set('allInInterests', $allInInterests);
    $allOutInterests = getOutInterests();
    $f3->set('allOutInterests', $allOutInterests);

    $view = new Template();
    echo $view->render('views/interests.html');
});

//summary route
$f3->route('GET /summary', function($f3){

    $view = new Template();
    echo $view->render('views/summary.html');
});

//run fat free
$f3->run();
