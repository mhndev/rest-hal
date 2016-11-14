<?php
namespace mhndev\restHal\interfaces;

/**
 * Interface iLink
 * @package mhndev\orderService\hal\interfaces
 */
interface iLink
{

    /**
     * @return string
     */
    function getName();

    /**
     * @return string
     */
    function getHrefAddress();
}
