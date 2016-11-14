<?php
namespace mhndev\restHal\interfaces;

/**
 * Interface iHalObjectResource
 * @package mhndev\orderService\hal\interfaces
 */
interface iHalObjectResource extends iHalObject
{

    /**
     * @return array | \Traversable
     */
    function getData();
}
