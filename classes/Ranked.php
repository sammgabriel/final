<?php

/**
 *
 * Author Name: Sam Gabriel, Nic Alexander
 * Date: March 20, 2019
 * File Name: Ranked.php
 *
 * Ranked player class
 *
 */
class Ranked extends Casual
{

    private $_idealPairs;
    private $_rank;

    public function __construct($platform, $tag, $heroes, $gameMode, $idealPairs, $rank)
    {

        parent::__construct($platform, $tag, $heroes, $gameMode);
        $this->_idealPairs = $idealPairs;
        $this->_rank = $rank;
    }

    /**
     *
     * gets the characters that the user wants
     * to be paired with
     *
     * @return mixed
     */
    public function getIdealPairs()
    {

        return $this->_idealPairs;
    }

    /**
     *
     * sets the characters that the user wants
     * to be paired with
     *
     * @param mixed $idealPairs
     */
    public function setIdealPairs($idealPairs)
    {

        $this->_idealPairs = $idealPairs;
    }

    /**
     *
     * gets the user's rank
     *
     * @return mixed
     */
    public function getRank()
    {

        return $this->_rank;
    }

    /**
     *
     * sets the user's rank
     *
     * @param mixed $rank
     */
    public function setRank($rank)
    {

        $this->_rank = $rank;
    }
}