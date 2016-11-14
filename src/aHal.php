<?php

namespace mhndev\restHal;
use mhndev\restHal\interfaces\iHalObject;

/**
 * Class aHal
 * @package mhndev\restHal
 */
abstract class aHal implements iHalObject
{
    /**
     * The uri represented by this representation.
     *
     * @var string
     */
    protected $selfUri;


    /**
     * @var string
     */
    protected $halType;

    /**
     * @var array of iLink
     */
    protected $links;


    /**
     * @return string
     */
    function getHalType()
    {
        return $this->halType;
    }

    /**
     * @return array []iLink
     */
    function getLinks()
    {
        return $this->links;
    }

    /**
     * @return string
     */
    public function getSelfUri()
    {
        return $this->selfUri;
    }
}
