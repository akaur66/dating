<?php
/*
 * Amardip Kaur
 * 4/27/20
 * this is the controller file
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start session
session_start();

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
$f3->route('GET|POST /personal', function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST') { //first time on page or submitted form//post or get

        //validate

        //else store data in the session array
        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];

        $f3->reroute('profile');
    }

    $view = new Template();
    echo $view->render('views/personal.html');
});

//profile route
$f3->route('GET|POST /profile', function($f3){

    $allStates = getStates();
    $f3->set('allStates', $allStates);

    if($_SERVER['REQUEST_METHOD'] == 'POST') { //post or get

        //validate

        //else store data in the session array
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['biography'] = $_POST['biography'];

        $f3->reroute('interests');
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

//interests route
$f3->route('GET|POST /interests', function($f3){

    $allInInterests = getInInterests();
    $f3->set('allInInterests', $allInInterests);
    $allOutInterests = getOutInterests();
    $f3->set('allOutInterests', $allOutInterests);

    if($_SERVER['REQUEST_METHOD'] == 'POST') { //post or get

        //validate

        //else store data in the session array
        $_SESSION['inInterests'] = $_POST['inInterest'];
        $_SESSION['outInterests'] = $_POST['outInterest'];

        $f3->reroute('summary');
    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

//summary route
$f3->route('GET|POST /summary', function($f3){
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});

//run fat free
$f3->run();
