<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    /**
     * Display the default route
     */
    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    public function personal()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') { //first time on page or submitted form//post or get

            // if input not valid, set error variable in f3 hive

            if (!$this->_validator->validName($_POST['firstName'])) {
                $this->_f3->set('errors["firstName"]', "Please enter first name");
            }
            if (!$this->_validator->validName($_POST['lastName'])) {
                $this->_f3->set('errors["lastName"]', "Please enter last name");
            }
            if (!$this->_validator->validAge($_POST['age'])) {
                $this->_f3->set('errors["age"]', "Please enter correct age");
            }
            if (!$this->_validator->validPhone($_POST['phone'])) {
                $this->_f3->set('errors["phone"]', "Please enter correct number");
            }

            //Data is valid
            if (empty($this->_f3->get('errors'))) {

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

                $this->_f3->reroute('profile');
            }
        }

        $this->_f3->set('firstName', $_POST['firstName']);
        $this->_f3->set('lastName', $_POST['lastName']);
        $this->_f3->set('age', $_POST['age']);
        $this->_f3->set('gender', $_POST['gender']);
        $this->_f3->set('phone', $_POST['phone']);
        $this->_f3->set('member', $_POST['member']);

        $view = new Template();
        echo $view->render('views/personal.html');
    }

    /**
     * Process the personal information route
     */
    public function profile()
    {
        $allStates = getStates();
        $this->_f3->set('allStates', $allStates);

        if($_SERVER['REQUEST_METHOD'] == 'POST') { //post or get

            // if input not valid, set error variable in f3 hive

            if (!$this->_validator->validEmail($_POST['email'])) {
                $this->_f3->set('errors["email"]', "Please enter correct email");
            }

            //Data is valid
            if (empty($this->_f3->get('errors'))) {

                // store data in the session array
                $_SESSION['member']->setEmail($_POST['email']);
                $_SESSION['member']->setState($_POST['state']);
                $_SESSION['member']->setSeeking($_POST['seeking']);
                $_SESSION['member']->setBio($_POST['biography']);

                if ($_SESSION['member'] instanceOf PremiumMember) { //show only if premium member
                    $this->_f3->reroute('interests');
                }
                else {
                    $this->_f3->reroute('summary');
                }
            }
        }

        $this->_f3->set('email', $_POST['email']);
        $this->_f3->set('selectedState', $_POST['state']);
        $this->_f3->set('seeking', $_POST['seeking']);
        $this->_f3->set('biography', $_POST['biography']);

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     * Process the vehicle information form route
     */
    public function interests()
    {
        $allInInterests = getInInterests();
        $this->_f3->set('allInInterests', $allInInterests);
        $allOutInterests = getOutInterests();
        $this->_f3->set('allOutInterests', $allOutInterests);

        if($_SERVER['REQUEST_METHOD'] == 'POST') { //post or get

            // if input not valid, set error variable in f3 hive

            if (isset($_POST['inInterest']) && !$this->_validator->validIndoors($_POST['inInterest'])) {
                $this->_f3->set('errors["indoors"]', "Wrong in-door interest selection");
            }
            if (isset($_POST['outInterest']) && !$this->_validator->validOutdoors($_POST['outInterest'])) {
                $this->_f3->set('errors["outdoors"]', "Wrong out-door interest selection");
            }

            //Data is valid
            if (empty($this->_f3->get('errors'))) {

                // store data in the session array
                $_SESSION['member']->setInDoorInterests($_POST['inInterest']);
                $_SESSION['member']->setOutDoorInterests($_POST['outInterest']);

                $this->_f3->reroute('summary');
            }
        }

        $this->_f3->set('selectedIn', $_POST['inInterest']);
        $this->_f3->set('selectedOut', $_POST['outInterest']);

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /**
     *
     */
    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');
        session_destroy();
    }
}