<?php
/**
 * Created by PhpStorm.
 * User: sammgabriel
 * Date: 2019-03-13
 * Time: 19:47
 */

class Ranked extends Casual {

    private $_idealPairs;
    private $_rank;

    public function __construct($platform, $tag, $heroes, $gameMode, $idealPairs, $rank)
    {
        parent::__construct($platform, $tag, $heroes, $gameMode);
        $this->_idealPairs = $idealPairs;
        $this->_rank = $rank;
    }

    /**
     * @return mixed
     */
    public function getIdealPairs()
    {
        return $this->_idealPairs;
    }

    /**
     * @param mixed $idealPairs
     */
    public function setIdealPairs($idealPairs)
    {
        $this->_idealPairs = $idealPairs;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->_rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->_rank = $rank;
    }


}