<?php

class PremiumMember extends Member
{
    //Declare instance variables
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * @return Array of indoor interests
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param $inDoorInterests array
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return array of out door interests
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param $outDoorInterests out door interests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

    /** toString() returns a String representation
     *  of a premium member name
     *  @return string
     */
    public function toString()
    {
        return $this->getFname() . " " . $this->getLname();
    }
}