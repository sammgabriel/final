<?php

class Casual {

    private $_platform;
    private $_tag;
    private $_heroes;
    private $_gameMode;


    function __construct($platform, $tag, $heroes, $gameMode)
    {

        $this->_platform = $platform;
        $this->_tag = $tag;
        $this->_heroes = $heroes;
        $this->_gameMode = $gameMode;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     * @param mixed $platform
     */
    public function setPlatform($platform)
    {
        $this->_platform = $platform;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->_tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->_tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getHeroes()
    {
        return $this->_heroes;
    }

    /**
     * @param mixed $heroes
     */
    public function setHeroes($heroes)
    {
        $this->_heroes = $heroes;
    }

    /**
     * @return mixed
     */
    public function getGameMode()
    {
        return $this->_gameMode;
    }

    /**
     * @param mixed $gameMode
     */
    public function setGameMode($gameMode)
    {
        $this->_gameMode = $gameMode;
    }

}