<?php
namespace mhndev\restHal\interfaces;

/**
 * Interface iHalObjectCollection
 * @package mhndev\orderService\hal\interfaces
 */
interface iHalObjectCollection extends iHalObject
{

    /**
     * @return integer
     */
    function getCount();

    /**
     * @return integer
     */
    function getTotal();

    /**
     * @return []iHalObject
     */
    function getEmbedded();
}
