<?php

/**
 * Class Member
 * Regular member information
 * @author Amardip Kaur
 * @version 1.0
 */
class Member
{
    //Declare instance variables
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * @param $fname first name
     * @param $lname last name
     * @param $age age
     * @param $gender gender
     * @param $phone phone number
     */
    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    /**
     * @return first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param $fname first name
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param $lname last name
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param $age age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param $gender gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param $phone phone number
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return email address
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param $email email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param $state state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param $seeking seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return biography
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param $bio biography
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

    /** toString() returns a String representation
     *  of a member name
     *  @return string
     */
    public function toString()
    {
        return $this->_fname . " " . $this->_lname;
    }
}
