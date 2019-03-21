<?php

/**
 *
 * Author Name: Sam Gabriel, Nic Alexander
 * Date: March 20, 2019
 * File Name: Casual.php
 *
 * Casual player class
 *
 */
class Casual
{

    private $_platform;
    private $_tag;
    private $_heroes;
    private $_gameMode;


    /**
     *
     * Creates a new casual player object
     *
     * @param $platform
     * @param $tag
     * @param $heroes
     * @param $gameMode
     *
     */
    function __construct($platform, $tag, $heroes, $gameMode)
    {

        $this->_platform = $platform;
        $this->_tag = $tag;
        $this->_heroes = $heroes;
        $this->_gameMode = $gameMode;
    }

    /**
     *
     * Returns the user's gaming platform
     *
     * @return mixed
     */
    public function getPlatform()
    {

        return $this->_platform;
    }

    /**
     *
     * sets the user's gaming platform
     *
     * @param mixed $platform
     */
    public function setPlatform($platform)
    {

        $this->_platform = $platform;
    }

    /**
     *
     * gets the user's gaming username
     *
     * @return mixed
     */
    public function getTag()
    {

        return $this->_tag;
    }

    /**
     *
     * sets the user's gaming username
     *
     * @param mixed $tag
     */
    public function setTag($tag)
    {

        $this->_tag = $tag;
    }

    /**
     *
     * gets the user's character choices
     *
     * @return mixed
     */
    public function getHeroes()
    {

        return $this->_heroes;
    }

    /**
     *
     * sets the user's character choices
     *
     * @param mixed $heroes
     */
    public function setHeroes($heroes)
    {

        $this->_heroes = $heroes;
    }

    /**
     *
     * gets the user's preferred game mode
     *
     * @return mixed
     */
    public function getGameMode()
    {

        return $this->_gameMode;
    }

    /**
     *
     * sets the user's preferred game mode
     *
     * @param mixed $gameMode
     */
    public function setGameMode($gameMode)
    {

        $this->_gameMode = $gameMode;
    }

}