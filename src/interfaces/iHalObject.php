<?php

namespace mhndev\restHal\interfaces;

/**
 * Interface iHalObject
 * @package mhndev\orderService\hal\interfaces
 */
interface iHalObject
{

    /**
     * @return string
     */
    function getHalType();


    /**
     * @return string
     */
    function getSelfUri();


    /**
     * @return []iLink
     */
    function getLinks();


    /**
     * @return string
     */
    function getHal();
}
