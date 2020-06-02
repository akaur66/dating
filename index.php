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
require_once("models/validate.php");

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

        // if input not valid, set error variable in f3 hive

        if (!validName($_POST['firstName'])) {
            $f3->set('errors["firstName"]', "Please enter first name");
        }
        if (!validName($_POST['lastName'])) {
            $f3->set('errors["lastName"]', "Please enter last name");
        }
        if (!validAge($_POST['age'])) {
            $f3->set('errors["age"]', "Please enter correct age");
        }
        if (!validPhone($_POST['phone'])) {
            $f3->set('errors["phone"]', "Please enter correct number");
        }

        //Data is valid
        if (empty($f3->get('errors'))) {

            //Create member object

            if (isset($_POST['member'])) { //check if premium
                $member = new PremiumMember($_POST['firstName'], $_POST['lastName'],
                    $_POST['age'], $_POST['gender'],  $_POST['phone'] );
            }
            else { //member class
                $member = new Member($_POST['firstName'], $_POST['lastName'],
                    $_POST['age'], $_POST['gender'], $_POST['phone']);
            }

            //Store the object in the session array
            $_SESSION['member'] = $member;

            $f3->reroute('profile');
        }
    }

    $f3->set('firstName', $_POST['firstName']);
    $f3->set('lastName', $_POST['lastName']);
    $f3->set('age', $_POST['age']);
    $f3->set('gender', $_POST['gender']);
    $f3->set('phone', $_POST['phone']);
    $f3->set('member', $_POST['member']);

    $view = new Template();
    echo $view->render('views/personal.html');
});

//profile route
$f3->route('GET|POST /profile', function($f3){

    $allStates = getStates();
    $f3->set('allStates', $allStates);

    if($_SERVER['REQUEST_METHOD'] == 'POST') { //post or get

        // if input not valid, set error variable in f3 hive

        if (!validEmail($_POST['email'])) {
            $f3->set('errors["email"]', "Please enter correct email");
        }

        //Data is valid
        if (empty($f3->get('errors'))) {

            // store data in the session array
            $_SESSION['member']->setEmail($_POST['email']);
            $_SESSION['member']->setState($_POST['state']);
            $_SESSION['member']->setSeeking($_POST['seeking']);
            $_SESSION['member']->setBio($_POST['biography']);

            if (is_a($_SESSION['member'], 'PremiumMember')) { //show only if premium member
                $f3->reroute('interests');
            }
            else {
                $f3->reroute('summary');
            }
        }
    }

    $f3->set('email', $_POST['email']);
    $f3->set('selectedState', $_POST['state']);
    $f3->set('seeking', $_POST['seeking']);
    $f3->set('biography', $_POST['biography']);

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

        // if input not valid, set error variable in f3 hive

        if (isset($_POST['inInterest']) && !validIndoors(($_POST['inInterest']))) {
            $f3->set('errors["indoors"]', "Wrong in-door interest selection");
        }
        if (isset($_POST['outInterest']) && !validOutdoors(($_POST['outInterest']))) {
        $f3->set('errors["outdoors"]', "Wrong out-door interest selection");
        }

        //Data is valid
        if (empty($f3->get('errors'))) {

            // store data in the session array
            $_SESSION['member']->setInDoorInterests($_POST['inInterest']);
            $_SESSION['member']->setOutDoorInterests($_POST['outInterest']);

            $f3->reroute('summary');
        }
    }

    $f3->set('selectedIn', $_POST['inInterest']);
    $f3->set('selectedOut', $_POST['outInterest']);

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
