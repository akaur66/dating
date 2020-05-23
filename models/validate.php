<?php
    function validName($name)
    {
        $name = str_replace(' ', '', $name); //remove white space
            //not empty         //all alphabets
        return !empty($name) && ctype_alpha($name);
    }

    function validAge($age)
    {
            //not empty         //numeric           //between 18 and 118
        return !empty($age) && is_numeric($age) && ($age >= 18 && $age <= 118);
    }

    function validPhone($number)
    {
        $number = str_replace(' ', '', $number); //remove white space
        //10 characters or more
        return strlen($number) >= 10;  // 1 if true
    }

    function validEmail($email)
    {
        $number = str_replace(' ', '', $email); //remove white space
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function validOutdoors($outdoor)
    {
        $outOptions = getOutInterests();

        foreach ($outdoor as $selectedOpt) {
            if (in_array($selectedOpt, $outOptions)) { //if valid option
                return true;
            }
            else{
                return false;
            }
        }

    }

    function validIndoors($indoor)
    {
        $inOptions = getInInterests();

        foreach ($indoor as $selectedOpt) {
            if (in_array($selectedOpt, $inOptions)) { //if valid option
                return true;
            }
            else{
                return false;
            }
        }
    }